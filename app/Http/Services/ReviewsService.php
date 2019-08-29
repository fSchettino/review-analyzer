<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class ReviewsService
{
    public function getReviewsList(int $hotel_id, int $service_id)
    {
        $hotels = [
            0 => ['id' => 1, 'hotelId' => 1, 'serviceId' => 1, 'score' => '5.5',],
            1 => ['id' => 2, 'hotelId' => 1, 'serviceId' => 2, 'score' => '4.5',],
            2 => ['id' => 3, 'hotelId' => 1, 'serviceId' => 3, 'score' => '3.5',]
        ];

        return $hotels;
    }

    public function show($id)
    {
        return 'Review Details';
    }

    public function add()
    {
        return 'Review Added';
    }

    public function edit($id)
    {
        return 'Review Updated';
    }

    public function delete($id)
    {
        return 'Review Deleted';
    }
}
