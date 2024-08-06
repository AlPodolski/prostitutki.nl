<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockDomain;
use App\Models\CityBlock;

class IndexController extends Controller
{
    public function index()
    {

        $cityBlock = CityBlock::get();

        $blockDomains = BlockDomain::get();

        return view('admin.index.index', compact('cityBlock', 'blockDomains'));
    }
}
