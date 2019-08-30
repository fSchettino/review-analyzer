<?php

namespace App\Http\Services;

use App\Http\Models\Hotel;
use Illuminate\Http\Request;

class HotelsService
{
    protected $hotelModel;

    public function __construct()
    {
        $this->hotelModel = new Hotel();
    }

    public function getHotelsList()
    {
        $hotels = [
            0 => ['id' => 1, 'name' => 'Hotel 1', 'reviews' => '75', 'avgScore' => '5.5', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']],
            1 => ['id' => 2, 'name' => 'Hotel 2', 'reviews' => '33', 'avgScore' => '4.5', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']],
            2 => ['id' => 3, 'name' => 'Hotel 3', 'reviews' => '67', 'avgScore' => '3.5', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']]
        ];

        return $hotels;
    }

    public function show($id)
    {
        return 'Hotel Details';
    }

    public function add()
    {
        return 'Hotel Added';
    }

    public function edit($id)
    {
        return 'Hotel Updated';
    }

    public function delete($id)
    {
        return 'Hotel Deleted';
    }
}
