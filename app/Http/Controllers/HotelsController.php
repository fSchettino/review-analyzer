<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelsController extends Controller
{
    public function index()
    {
        $hotels = [
            0 => ['name' => 'Hotel 1', 'avgScore' => '5.5',],
            1 => ['name' => 'Hotel 2', 'avgScore' => '4.5',],
            2 => ['name' => 'Hotel 3', 'avgScore' => '3.5',]
        ];

        $hotelInfo = ['name' => 'Hotel 1', 'avgScore' => '5.5',];

        return view('index', ['hotels' => $hotelInfo]);
    }
}
