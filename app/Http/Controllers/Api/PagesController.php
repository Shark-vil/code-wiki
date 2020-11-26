<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;

class PagesController extends Controller
{
    public function get($id = null)
    {
        if (!is_null($id))
            return response()
                ->json(Page::where('id', $id)->first(), 200);

        return response()->json(Page::get(), 200);
    }

    public function create(Request $request)
    {
        if ($request->has('name') && $request->has('category')) {
            $name = $request->input('name');
            $library = $request->input('library');
            $categoryName = $request->input('category');
            $content = $request->input('content');

            $category = Category::where('name', $categoryName)->first();
            if ($category) {
                $category_id = $category->id;
                $library = (empty(trim($library))) ? "Global" : $library;

                $page = Page::where('name', $name)->where('library', $library)->first();

                if (is_null($page)) {
                    $page = Page::create([
                        'library' => $library,
                        'name' => $name,
                        'content' => $content,
                        'category_id' => $category_id
                    ]);
                    return response()->json($page, 200);
                }
            } else {
                return response()->json(['error' => 'Такой категории не существует'], 412);
            }
        }

        return response()->json(['error' => 'Отсутствуют необходимые параметры'], 412);
    }
}