<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Interfaces\HotelsServiceInterface;

class HotelsController extends Controller
{
    protected $hotelsServiceInterface;

    public function __construct(HotelsServiceInterface $hotelsServiceInterface)
    {
        $this->hotelsServiceInterface = $hotelsServiceInterface;
    }

    // Load index page with hotels list
    public function all()
    {
        $hotels = $this->hotelsServiceInterface->all();
        return view('hotels.index', ['hotels' => $hotels]);
    }

    // Load hotel detail page
    public function find(Request $request)
    {
        $hotelId = $request->id;
        $hotel = $this->hotelsServiceInterface->find($hotelId);
        return view('hotels.show', ['hotel' => $hotel]);
    }

    // Load add hotel page
    public function create(Request $request)
    {
        $data = ['name' => $request->name, 'description' => $request->description, 'rooms' => $request->rooms, 'services' => $request->services, 'rules' => $request->rules];
        
        if ($request->isMethod('get')) {
            $getAddViewHotelData = $this->hotelsServiceInterface->getAddViewHotelData();
            return view('hotels.add', ['services' => $getAddViewHotelData['services'], 'rules' => $getAddViewHotelData['rules']]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->hotelsServiceInterface->create($data);
            if ($insertResponse == 'Hotel inserted') {
                $hotels = $this->hotelsServiceInterface->all();
                return redirect('hotels')->with('hotels', $hotels);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Load update hotel page
    public function edit(Request $request)
    {
        $hotelId = $request->id;
        $data = ['name' => $request->name, 'description' => $request->description, 'rooms' => $request->rooms, 'services' => $request->services, 'rules' => $request->rules];

        if ($request->isMethod('get')) {
            $hotel = $this->hotelsServiceInterface->find($hotelId);
            $getAddViewHotelData = $this->hotelsServiceInterface->getAddViewHotelData();
            return view('hotels.edit', ['hotel' => $hotel, 'services' => $getAddViewHotelData['services'], 'rules' => $getAddViewHotelData['rules']]);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->hotelsServiceInterface->edit($data, $hotelId);
            if ($updateResponse == 'Hotel updated') {
                $hotels = $this->hotelsServiceInterface->all();
                return redirect('hotels')->with('hotels', $hotels);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete hotel and reload hotels list page
    public function delete($id)
    {
        $deleteResponse = $this->hotelsServiceInterface->delete($id);
        if ($deleteResponse == 'Hotel deleted') {
            $hotels = $this->hotelsServiceInterface->all();
            return redirect('hotels')->with('hotels', $hotels);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
