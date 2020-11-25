<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', route('api.categories.get'), [
            'query' => ['api_token' => Auth::user()->api_token],
        ]);

        return view('categories.index', [
            'categories' => json_decode($response->getBody())
        ]);
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        
        if (is_null($category))
            return redirect()->route('categories');

        return view('categories.edit', [
            'category' => $category
        ]);
    }
}
