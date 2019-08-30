<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ReviewsService;

class ReviewsController extends Controller
{
    protected $reviewsServiceClass;

    public function __construct()
    {
        $this->reviewsServiceClass = new ReviewsService();
    }

    public function index()
    {
        $reviews = $this->reviewsServiceClass->getReviewsList();
        return view('hotels.show', ['reviews' => $reviews]);
    }

    public function show($id)
    {
        return view('hotels.show');
    }

    public function add()
    {
        return view('hotels.show');
    }

    public function edit($id)
    {
        return view('hotels.show');
    }

    public function delete($id)
    {
        return view('hotels.show');
    }
}
