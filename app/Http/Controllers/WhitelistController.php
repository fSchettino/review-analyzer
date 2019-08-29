<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\WhitelistService;

class WhitelistController extends Controller
{
    public function index()
    {
        $whitelistServiceClass = new WhitelistService();
        $whiteList = $whitelistServiceClass->getWhitelistKeywords();
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
