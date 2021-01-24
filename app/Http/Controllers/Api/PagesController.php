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

    public function delete($id)
    {
        $page = Page::where('id', $id)->first();
        if ($page) {
            $response = $page;
            $page->delete();
            return response()->json($response, 200);
        }

        return response()->json(['error' => 'Страница не найдена'], 412);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('name') && $request->has('category')) {
            $page = Page::where('id', $id)->first();
            if ($page) {
                if ($page->name != $request->name && $page->library != $request->library) {
                    if (Page::where('name', $request->name)->where('library', $request->library)->first())
                        return response()->json(['error' => 
                            'Страница с такими параметрами уже существует'
                        ], 412);
                }

                $categoryName = $request->input('category');
                $category = Category::where('name', $categoryName)->first();
                if ($category) {
                    $library = $request->input('library');
                    // $library = (empty(trim($library))) ? "Other" : $library;
                    
                    $page->update([
                        'name' => $request->name,
                        'library' => $library,
                        'content' => $request->content,
                        'category_id' => $category->id,
                        'is_server' => isset($request->is_server),
                        'is_client' => isset($request->is_client),
                        'is_menu' => isset($request->is_menu),
                    ]);
                    return response()->json($page, 200);
                }
            }
        }

        return response()->json(['error' => 'Отсутствуют необходимые параметры'], 412);
    }

    public function create(Request $request)
    {
        if ($request->has('name') && $request->has('category')) {
            $name = $request->input('name');
            $library = $request->input('library');
            $categoryName = $request->input('category');
            $content = $request->input('content');
            $is_server = $request->input('is_server');
            $is_client = $request->input('is_client');
            $is_menu = $request->input('is_menu');

            $category = Category::where('name', $categoryName)->first();
            if ($category) {
                $category_id = $category->id;
                // $library = (empty(trim($library))) ? "Other" : $library;

                $page = Page::where('name', $name)->where('library', $library)->first();

                if (is_null($page)) {
                    $page = Page::create([
                        'library' => $library,
                        'name' => $name,
                        'content' => $content,
                        'category_id' => $category_id,
                        'is_server' => isset($is_server),
                        'is_client' => isset($is_client),
                        'is_menu' => isset($is_menu),
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