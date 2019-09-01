<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HotelsService;

class HotelsController extends Controller
{
    protected $hotelsServiceClass;

    public function __construct()
    {
        $this->hotelsServiceClass = new HotelsService();
    }

    public function index()
    {
        $hotels = $this->hotelsServiceClass->showAll();
        return view('hotels.index', ['hotels' => $hotels]);
    }

    public function show($id)
    {
        return view('hotels.show');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $getAddViewHotelData = $this->hotelsServiceClass->getAddViewHotelData();
            return view('hotels.add', ['services' => $getAddViewHotelData['services'], 'rules' => $getAddViewHotelData['rules']]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->hotelsServiceClass->add($request);
            if ($insertResponse == 'Hotel inserted') {
                $hotels = $this->hotelsServiceClass->showAll();
                return view('hotels.index', ['hotels' => $hotels]);
            } else {
                return view('error')->with('error', $insertResponse);
            };
        }
    }

    public function edit($id)
    {
        return view('hotels.edit');
    }

    public function delete($id)
    {
        $deleteResponse = $this->hotelsServiceClass->delete($id);
        if ($deleteResponse == 'Hotel deleted') {
            $hotels = $this->hotelsServiceClass->showAll();
            return view('hotels.index', ['hotels' => $hotels]);
        } else {
            return view('error')->with('error', $deleteResponse);
        };
    }
}
