<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modules\Review\Interfaces\ReviewServiceInterface;
use App\Modules\Hotel\Interfaces\HotelServiceInterface;

class ReviewController extends Controller
{
    protected $reviewServiceInterface;
    protected $hotelServiceInterface;

    public function __construct(ReviewServiceInterface $reviewServiceInterface, HotelServiceInterface $hotelServiceInterface)
    {
        $this->reviewServiceInterface = $reviewServiceInterface;
        $this->hotelServiceInterface = $hotelServiceInterface;
    }

    // Load add review page
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $hotelData = $this->hotelServiceInterface->find($request->hotelId);
            return view('reviews.add', ['hotel' => $hotelData]);
        } elseif ($request->isMethod('post')) {
            $data = ['hotelId' => $request->hotelId, 'title' => $request->title, 'description' => $request->description];
            $insertResponse = $this->reviewServiceInterface->create($data);
            if ($insertResponse == 'Review inserted') {
                $hotels = $this->hotelServiceInterface->all();
                return redirect('hotels')->with('hotels', $hotels);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Delete review and reload hotels list page to show new hotel average score and order
    public function delete($id)
    {
        $deleteResponse = $this->reviewServiceInterface->delete($id);
        if ($deleteResponse == 'Review deleted') {
            $hotels = $this->hotelServiceInterface->all();
            return redirect('hotels')->with('hotels', $hotels);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
