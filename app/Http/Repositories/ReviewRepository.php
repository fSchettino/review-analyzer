<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

use App\Http\Models\Review;
use App\Http\Interfaces\ReviewRepositoryInterface;
use App\Http\Interfaces\HotelsServiceInterface;

use App\Http\Middleware\ReviewAnalyzer;

class ReviewRepository implements ReviewRepositoryInterface
{
    protected $reviewModel;
    protected $hotelsServiceInterface;

    protected $reviewAnalyzer;
    
    public function __construct(Review $review, HotelsServiceInterface $hotelsServiceInterface, ReviewAnalyzer $reviewAnalyzer)
    {
        $this->reviewModel = $review;
        $this->hotelsServiceInterface = $hotelsServiceInterface;
        $this->reviewAnalyzer = $reviewAnalyzer;
    }
    
    public function create(array $data)
    {
        try {
            $this->reviewModel->hotel_id = $data['hotelId'];
            $this->reviewModel->title = $data['title'];
            $this->reviewModel->description = $data['description'];
            $this->reviewModel->score = $this->reviewAnalyzer->calculateScore($data['hotelId'], $data['title'], $data['description']);
            $this->reviewModel->save();

            // update hotel score
            $this->hotelsServiceInterface->updateHotelScore($this->reviewModel->hotel_id);
            
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

            // update hotel score
            $this->hotelsServiceInterface->updateHotelScore($review->hotel->id);

            return 'Review deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
