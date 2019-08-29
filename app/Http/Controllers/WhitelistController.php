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

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('keywords.whiteList.add');
        } elseif ($request->isMethod('post')) {
            $whitelistKeywordData = $request->all();
            // $request->getParam('name');
            // $request->getParam('weight');
            $whitelistServiceClass = new WhitelistService();
            $whiteList = $whitelistServiceClass->getWhitelistKeywords($whitelistKeywordData);
            return view('keywords.whiteList.index', ['whiteList' => $whiteList]);
        }
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
