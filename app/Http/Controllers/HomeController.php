<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check())
            return redirect()->route('wiki');

        return view('home');
    }

    public function wiki($id = null)
    {
        $wikiStorage = [];

        $categories = Category::orderBy('name')->get();

        foreach ($categories as $key => $category) {
            $item = [
                'category' => $category,
                'libraries' => []
            ];

            $categoryId = array_push($wikiStorage, $item) - 1;
            $pages = Page::where('category_id', $category->id)
                ->orderBy('library')
                ->orderBy('name')
                ->get();
            
            $lastLibrary = null;
            foreach ($pages as $key => $page) {
                if ($page->library != $lastLibrary) {
                    $lastLibrary = $page->library;
                    $wikiStorage[$categoryId]['libraries'][$lastLibrary] = [];
                }

                array_push($wikiStorage[$categoryId]['libraries'][$lastLibrary], $page);       
            }
            
            $wikiStorage[$categoryId]['libCount'] = count($wikiStorage[$categoryId]['libraries'], COUNT_RECURSIVE) - count($wikiStorage[$categoryId]['libraries']);
        }

        $idSplit = null;
        if (isset($id) && !empty($id))
            $idSplit = mb_split('\.', $id);

        if (is_null($idSplit) || count($idSplit) != 2) {
            return view('wiki', [
                'wikiStorage' => $wikiStorage,
                'getPage' => null
            ]);
        }

        $getPage = Page::where('library', $idSplit[0])->where('name', $idSplit[1])->first();

        return view('wiki', [
            'wikiStorage' => $wikiStorage,
            'getPage' => $getPage
        ]);
    }
}
