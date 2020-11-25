<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function get($id = null)
    {
        if (!is_null($id))
            return response()
                ->json(Category::where('id', $id)->first(), 200);

        return response()->json(Category::get(), 200);
    }

    public function delete($id)
    {
        $category = Category::where('id', $id)->first();
        if ($category) {
            $response = $category;
            $category->delete();
            return response()->json($response, 200);
        }

        return response()->json(['error' => 'Категория не найдена'], 412);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('name')) {
            $category = Category::where('id', $id)->first();
            if ($category) {
                $category->update([
                    'name' => $request->name
                ]);
                return response()->json($category, 200);
            }
        }

        return response()->json(['error' => 'Отсутствуют необходимые параметры'], 412);
    }
}
