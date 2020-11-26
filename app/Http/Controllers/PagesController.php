<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Page;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', route('api.pages.get'), [
            'query' => ['api_token' => Auth::user()->api_token],
        ]);

        return view('pages.index', [
            'pages' => json_decode($response->getBody())
        ]);
    }

    public function edit($id)
    {
        $page = Page::where('id', $id)->first();
        
        if (is_null($page))
            return redirect()->route('pages');

        $categories = Category::get();

        return view('pages.edit', [
            'page' => $page,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::get();

        return view('pages.create', [
            'categories' => $categories
        ]);
    }
}
