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
        $hotels = $this->hotelsServiceClass->getHotelsList();
        return view('hotels.index', ['hotels' => $hotels]);
    }

    public function show($id)
    {
        return view('hotels.show');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            // Get all availables hotel services (Dummy data)
            $services = [
                0 => ['id' => 1, 'name' => 'Service 1'],
                1 => ['id' => 2, 'name' => 'Service 2'],
                2 => ['id' => 3, 'name' => 'Service 3']
            ];

            // Get all whitelist keywords
            $whitelistKeywords = [
                0 => ['id' => 1, 'name' => 'Good', 'weight' => '1',],
                1 => ['id' => 2, 'name' => 'Exelent', 'weight' => '1',],
                2 => ['id' => 3, 'name' => 'Awesome', 'weight' => '1',]
            ];

            // Get all blacklist keywords
            $blacklistKeywords = [
                0 => ['id' => 1, 'name' => 'Bad', 'weight' => '1',],
                1 => ['id' => 2, 'name' => 'Dreadful', 'weight' => '1',],
                2 => ['id' => 3, 'name' => 'Appalling', 'weight' => '1',]
            ];

            return view('hotels.add', ['services' => $services, 'whitelistKeywords' => $whitelistKeywords, 'blacklistKeywords' => $blacklistKeywords]);
        } elseif ($request->isMethod('post')) {
            $hotelData = $request->all();
            $hotels = $this->hotelsServiceClass->getHotelsList($hotelData);
            return view('hotels.index', ['hotels' => $hotels]);
        }
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
