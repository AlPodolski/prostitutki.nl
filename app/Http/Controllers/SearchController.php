<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke($city, Request $request)
    {
        $cityInfo = $this->cityRepository->getCity($city);
        $data = $this->dataRepository->getData($cityInfo['id']);
        $posts = $this->postRepository->getForSearch($cityInfo['id'], $request->get('name'));
        $meta = $this->metaRepository->getForSearch();

        $path = '/';

        return view('index.index', compact('posts', 'data', 'meta', 'path'));
    }
}