<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('id')) {
            return response(
                Category::where('id', $request->input('id')->first())
            );
        }

        return response(
            Category::get()
        );
    }
}
