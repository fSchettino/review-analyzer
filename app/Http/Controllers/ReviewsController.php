<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Interfaces\ReviewsServiceInterface;
use App\Http\Interfaces\HotelsServiceInterface;

class ReviewsController extends Controller
{
    protected $ReviewsServiceInterface;
    protected $hotelsServiceInterface;

    public function __construct(ReviewsServiceInterface $reviewsServiceInterface, HotelsServiceInterface $hotelsServiceInterface)
    {
        $this->reviewsServiceInterface = $reviewsServiceInterface;
        $this->hotelsServiceInterface = $hotelsServiceInterface;
    }

    // Load add review page
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $hotelData = $this->hotelsServiceInterface->find($request->hotelId);
            return view('reviews.add', ['hotel' => $hotelData]);
        } elseif ($request->isMethod('post')) {
            $data = ['hotelId' => $request->hotelId, 'title' => $request->title, 'description' => $request->description];
            $insertResponse = $this->reviewsServiceInterface->create($data);
            if ($insertResponse == 'Review inserted') {
                $hotels = $this->hotelsServiceInterface->all();
                return redirect('hotels')->with('hotels', $hotels);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Delete review and reload hotels list page to show new hotel average score and order
    public function delete($id)
    {
        $deleteResponse = $this->reviewsServiceInterface->delete($id);
        if ($deleteResponse == 'Review deleted') {
            $hotels = $this->hotelsServiceInterface->all();
            return redirect('hotels')->with('hotels', $hotels);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
