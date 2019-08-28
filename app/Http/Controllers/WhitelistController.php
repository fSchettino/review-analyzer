<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhitelistController extends Controller
{
    public function index()
    {
        $whiteList = ['Keyword 1', 'Keyword 2', 'Keyword 3'];

        return view('keywords.whiteList.index', ['whiteList' => $whiteList]);
    }

    public function show($id)
    {
        return view('keywords.whiteList.show');
    }

    public function add()
    {
        return view('keywords.whiteList.add');
    }

    public function edit($id)
    {
        return view('keywords.whiteList.edit');
    }

    public function delete($id)
    {
        return view('keywords.whiteList.index');
    }
}
