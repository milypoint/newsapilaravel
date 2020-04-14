<?php


namespace App\Http\Controllers;

use App\NewsApi\NewsApiRequestEverything;

class SearchController extends Controller
{
    public function index()
    {
        // make request:
        $result = [];
        if (!empty($_GET)) {
            $request = new NewsApiRequestEverything($_GET);
            $result = $request->request();
            return view('result', $result);
        }
        // make view:
        return view('search', array_merge($_GET));
    }

}
