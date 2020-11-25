<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('id'))
            return response()
                ->json(Category::where('id', $request->input('id'))->first(), 200);

        return response()->json(Category::get(), 200);
    }

    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            $category = Category::where('id', $request->input('id'))->first();
            if ($category) {
                $response = $category;
                $category->delete();
                return response()->json($response, 200);
            };
        }

        return response()->json(['error' => ''], 412);
    }
}
