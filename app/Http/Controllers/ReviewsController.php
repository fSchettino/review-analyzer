<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ReviewsService;
use App\Http\Services\HotelsService;

class ReviewsController extends Controller
{
    protected $reviewsServiceClass;
    protected $hotelsServiceClass;

    public function __construct()
    {
        $this->reviewsServiceClass = new ReviewsService();
        $this->hotelsServiceClass = new HotelsService();
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $hotelData = $this->hotelsServiceClass->show($request->hotelId);
            return view('reviews.add', ['hotel' => $hotelData]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->reviewsServiceClass->add($request);
            if ($insertResponse == 'Review inserted') {
                $hotels = $this->hotelsServiceClass->showAll();
                return view('hotels.index', ['hotels' => $hotels]);
            } else {
                return view('error')->with('error', $insertResponse);
            };
        }
    }

    public function delete($id)
    {
        $deleteResponse = $this->reviewsServiceClass->delete($id);
        if ($deleteResponse == 'Review deleted') {
            $hotels = $this->hotelsServiceClass->showAll();
            return view('hotels.index', ['hotels' => $hotels]);
        } else {
            return view('error')->with('error', $deleteResponse);
        };
    }
}
