<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BlacklistService;

class BlacklistController extends Controller
{
    protected $blacklistServiceClass;

    public function __construct()
    {
        $this->blacklistServiceClass = new BlacklistService();
    }

    public function index()
    {
        $blackList = $this->blacklistServiceClass->showAll();
        return view('keywords.blackList.index', ['blackList' => $blackList]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('keywords.blackList.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->blacklistServiceClass->add($request);
            if ($insertResponse == 'keyword inserted') {
                $blackList = $this->blacklistServiceClass->showAll();
                return view('keywords.blackList.index', ['blackList' => $blackList]);
            } else {
                return view('error')->with('error', $deleteResponse);
            };
        }
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $blacklistKeyword = $this->blacklistServiceClass->edit($request);
            return view('keywords.blackList.edit')->with('blacklistKeyword', $blacklistKeyword);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->blacklistServiceClass->edit($request);
            if ($updateResponse == 'keyword updated') {
                $blackList = $this->blacklistServiceClass->showAll();
                return view('keywords.blackList.index', ['blackList' => $blackList]);
            } else {
                return view('error')->with('error', $updateResponse);
            };
        }
    }

    public function delete($id)
    {
        $deleteResponse = $this->blacklistServiceClass->delete($id);
        if ($deleteResponse == 'keyword deleted') {
            $blackList = $this->blacklistServiceClass->showAll();
            return view('keywords.blackList.index', ['blackList' => $blackList]);
        } else {
            return view('error')->with('error', $deleteResponse);
        };
    }
}
