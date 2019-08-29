<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BlacklistService;

class BlacklistController extends Controller
{
    public function index()
    {
        $blacklistServiceClass = new BlacklistService();
        $blackList = $blacklistServiceClass->getBlacklistKeywords();
        return view('keywords.blacklist.index', ['blackList' => $blackList]);
    }

    public function show($id)
    {
        return view('keywords.blacklist.show');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('keywords.blacklist.add');
        } elseif ($request->isMethod('post')) {
            // $request->getParam('name');
            // $request->getParam('weight');
            $blacklistServiceClass = new BlacklistService();
            $blackList = $blacklistServiceClass->getBlacklistKeywords();
            return view('keywords.blacklist.index', ['blackList' => $blackList]);
        }
    }

    public function edit($id)
    {
        return view('keywords.blacklist.edit');
    }

    public function delete($id)
    {
        return view('keywords.blacklist.index');
    }
}
