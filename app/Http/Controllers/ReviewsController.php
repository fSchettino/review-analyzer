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

    // Load add review page
    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $hotelData = $this->hotelsServiceClass->show($request->hotelId);
            return view('reviews.add', ['hotel' => $hotelData]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->reviewsServiceClass->add($request);
            if ($insertResponse == 'Review inserted') {
                $hotels = $this->hotelsServiceClass->showAll();
                return redirect('hotels')->with('hotels', $hotels);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Delete review and reload hotels list page to show new hotel average score and order
    public function delete($id)
    {
        $deleteResponse = $this->reviewsServiceClass->delete($id);
        if ($deleteResponse == 'Review deleted') {
            $hotels = $this->hotelsServiceClass->showAll();
            return redirect('hotels')->with('hotels', $hotels);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
