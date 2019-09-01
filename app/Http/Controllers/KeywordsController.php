<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\KeywordsService;

class KeywordsController extends Controller
{
    protected $keywordsServiceClass;

    public function __construct()
    {
        $this->keywordsServiceClass = new KeywordsService();
    }

    public function index()
    {
        $keywords = $this->keywordsServiceClass->showAll();
        return view('keywords.index', ['keywords' => $keywords]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('keywords.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->keywordsServiceClass->add($request);
            if ($insertResponse == 'Keyword inserted') {
                $keywords = $this->keywordsServiceClass->showAll();
                return view('keywords.index', ['keywords' => $keywords]);
            } else {
                return view('error')->with('error', $insertResponse);
            };
        }
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $keyword = $this->keywordsServiceClass->edit($request);
            return view('keywords.edit')->with('keyword', $keyword);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->keywordsServiceClass->edit($request);
            if ($updateResponse == 'Keyword updated') {
                $keywords = $this->keywordsServiceClass->showAll();
                return view('keywords.index', ['keywords' => $keywords]);
            } else {
                return view('error')->with('error', $updateResponse);
            };
        }
    }

    public function delete($id)
    {
        $deleteResponse = $this->keywordsServiceClass->delete($id);
        if ($deleteResponse == 'Keyword deleted') {
            $keywords = $this->keywordsServiceClass->showAll();
            return view('keywords.index', ['keywords' => $keywords]);
        } else {
            return view('error')->with('error', $deleteResponse);
        };
    }
}
