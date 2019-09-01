<?php

namespace App\Http\Services;

use App\Http\Models\Review;
use App\Http\Services\HotelsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsService
{
    protected $reviewModel;
    protected $hotelsServiceClass;

    public function __construct()
    {
        $this->reviewModel = new Review();
        $this->hotelsServiceClass = new HotelsService();
    }

    public function add(Request $request)
    {
        try {
            $this->reviewModel->hotel_id = $request->hotelId;
            $this->reviewModel->title = $request->title;
            $this->reviewModel->description = $request->description;
            $this->reviewModel->score = $this->analyzeReview($request->description);
            $this->reviewModel->save();
            return 'Review inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $review = $this->reviewModel->find($id);
            $review->delete();
            DB::commit();

            return 'Review deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function analyzeReview($reviewDescription)
    {
        return 5;
    }
}
