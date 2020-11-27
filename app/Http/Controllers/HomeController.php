<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

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
                'libraries' => [],
                'pages' => []
            ];

            $categoryId = array_push($wikiStorage, $item) - 1;
            $pages = Page::where('category_id', $category->id)
                ->orderBy('library')
                ->orderBy('name')
                ->get();
            
            $lastLibrary = null;
            foreach ($pages as $key => $page) {
                if ($page->library == null) {
                    array_push($wikiStorage[$categoryId]['pages'], $page);
                } else {
                    if ($page->library != $lastLibrary) {
                        $lastLibrary = $page->library;
                        $wikiStorage[$categoryId]['libraries'][$lastLibrary] = [];
                    }

                    array_push($wikiStorage[$categoryId]['libraries'][$lastLibrary], $page);
                }
            }
            
            $wikiStorage[$categoryId]['pageCount'] = count($wikiStorage[$categoryId]['libraries'], COUNT_RECURSIVE) - count($wikiStorage[$categoryId]['libraries']);
            $wikiStorage[$categoryId]['pageCount'] += count($wikiStorage[$categoryId]['pages']);
        }

        $idSplit = null;
        if (isset($id) && !empty($id))
            $idSplit = mb_split('\.', $id);

        $agent = new Agent();

        $splitCount = (is_null($idSplit)) ? 0 : count($idSplit);
        if (is_null($idSplit) || $splitCount > 2 || $splitCount == 0) {
            return view('wiki', [
                'wikiStorage' => $wikiStorage,
                'getPage' => null,
                'agent' => $agent
            ]);
        }

        $getPage;
        if ($splitCount == 1)
            $getPage = Page::where('name', $idSplit[0])->first();
        else
            $getPage = Page::where('library', $idSplit[0])->where('name', $idSplit[1])->first();

        return view('wiki', [
            'wikiStorage' => $wikiStorage,
            'getPage' => $getPage,
            'agent' => $agent
        ]);
    }
}
