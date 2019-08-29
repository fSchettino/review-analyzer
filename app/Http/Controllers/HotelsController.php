<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HotelsService;

class HotelsController extends Controller
{
    public function index()
    {
        $hotelsServiceClass = new HotelsService();
        $hotels = $hotelsServiceClass->getHotelsList();
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
        return view('hotels.delete');
    }
}
