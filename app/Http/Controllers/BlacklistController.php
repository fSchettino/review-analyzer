<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    public function index()
    {
        $blackList = ['Keyword 1', 'Keyword 2', 'Keyword 3'];

        return view('blacklist', ['blackList' => $blackList]);
    }
}
