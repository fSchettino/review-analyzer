<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Services\HotelsService as HotelsService;

class HotelsController extends Controller
{
    public function index()
    {
        // $HotelService = new HotelService;
        // $hotels = app->HotelsService->getHotelsList();
        $hotels = app('App\Http\Services\HotelsService')->getHotelsList();
        return view('hotels.index', ['hotels' => $hotels]);
    }

    public function show($id)
    {
        return view('hotels.show');
    }

    public function add()
    {
        return view('hotels.add');
    }

    public function edit($id)
    {
        return view('hotels.edit');
    }

    public function delete($id)
    {
        return view('hotels.hotels');
    }
}
