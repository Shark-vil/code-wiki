<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
