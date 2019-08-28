<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhitelistController extends Controller
{
    public function index()
    {
        // $whiteList = ['Keyword 1', 'Keyword 2', 'Keyword 3'];

        // return view('whiteList', ['whiteList' => $whiteList]);
        return view('whiteList');
    }
}
