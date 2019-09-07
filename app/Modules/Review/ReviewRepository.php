<?php

namespace App\Modules\Review;

use Illuminate\Support\Facades\DB;

use App\Modules\Review\Review;
use App\Modules\Review\Interfaces\ReviewRepositoryInterface;
use App\Modules\Hotel\Interfaces\HotelServiceInterface;

use App\Modules\Review\ReviewAnalyzer;

class ReviewRepository implements ReviewRepositoryInterface
{
    protected $reviewModel;
    protected $hotelServiceInterface;

    protected $reviewAnalyzer;
    
    public function __construct(Review $review, HotelServiceInterface $hotelServiceInterface, ReviewAnalyzer $reviewAnalyzer)
    {
        $this->reviewModel = $review;
        $this->hotelServiceInterface = $hotelServiceInterface;
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
            $this->hotelServiceInterface->updateHotelScore($this->reviewModel->hotel_id);
            
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
            $this->hotelServiceInterface->updateHotelScore($review->hotel->id);

            return 'Review deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
