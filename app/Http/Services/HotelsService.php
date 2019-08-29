<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class HotelsService
{
    public function getHotelsList()
    {
        $hotels = [
            0 => ['id' => 1, 'name' => 'Hotel 1', 'avgScore' => '5.5', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']],
            1 => ['id' => 2, 'name' => 'Hotel 2', 'avgScore' => '4.5', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']],
            2 => ['id' => 3, 'name' => 'Hotel 3', 'avgScore' => '3.5', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']]
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
