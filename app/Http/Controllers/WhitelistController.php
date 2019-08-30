<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\WhitelistService;

class WhitelistController extends Controller
{
    protected $whitelistServiceClass;

    public function __construct()
    {
        $this->whitelistServiceClass = new WhitelistService();
    }

    public function index()
    {
        $whiteList = $this->whitelistServiceClass->showAll();
        return view('keywords.whiteList.index', ['whiteList' => $whiteList]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('keywords.whiteList.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->whitelistServiceClass->add($request);
            if ($insertResponse == 'keyword inserted') {
                $whiteList = $this->whitelistServiceClass->showAll();
                return view('keywords.whiteList.index', ['whiteList' => $whiteList]);
            } else {
                return view('error')->with('error', $deleteResponse);
            };
        }
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $whitelistKeyword = $this->whitelistServiceClass->edit($request);
            return view('keywords.whiteList.edit')->with('whitelistKeyword', $whitelistKeyword);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->whitelistServiceClass->edit($request);
            if ($updateResponse == 'keyword updated') {
                $whiteList = $this->whitelistServiceClass->showAll();
                return view('keywords.whiteList.index', ['whiteList' => $whiteList]);
            } else {
                return view('error')->with('error', $updateResponse);
            };
        }
    }

    public function delete($id)
    {
        $deleteResponse = $this->whitelistServiceClass->delete($id);
        if ($deleteResponse == 'keyword deleted') {
            $whiteList = $this->whitelistServiceClass->showAll();
            return view('keywords.whiteList.index', ['whiteList' => $whiteList]);
        } else {
            return view('error')->with('error', $deleteResponse);
        };
    }
}
