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

    // Load index page with hotels list
    public function index()
    {
        $hotels = $this->hotelsServiceClass->showAll();
        return view('hotels.index', ['hotels' => $hotels]);
    }

    // Load hotel detail page
    public function show(Request $request)
    {
        $hotel = $this->hotelsServiceClass->show($request->id);
        return view('hotels.show', ['hotel' => $hotel]);
    }

    // Load add hotel page
    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $getAddViewHotelData = $this->hotelsServiceClass->getAddViewHotelData();
            return view('hotels.add', ['services' => $getAddViewHotelData['services'], 'rules' => $getAddViewHotelData['rules']]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->hotelsServiceClass->add($request);
            if ($insertResponse == 'Hotel inserted') {
                $hotels = $this->hotelsServiceClass->showAll();
                return redirect('hotels')->with('hotels', $hotels);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Load update hotel page
    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $getAddViewHotelData = $this->hotelsServiceClass->getAddViewHotelData();
            $hotel = $this->hotelsServiceClass->show($request->id);
            return view('hotels.edit', ['hotel' => $hotel, 'services' => $getAddViewHotelData['services'], 'rules' => $getAddViewHotelData['rules']]);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->hotelsServiceClass->edit($request);
            if ($updateResponse == 'Hotel updated') {
                $hotels = $this->hotelsServiceClass->showAll();
                return redirect('hotels')->with('hotels', $hotels);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete hotel and reload hotels list page
    public function delete($id)
    {
        $deleteResponse = $this->hotelsServiceClass->delete($id);
        if ($deleteResponse == 'Hotel deleted') {
            $hotels = $this->hotelsServiceClass->showAll();
            return redirect('hotels')->with('hotels', $hotels);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
