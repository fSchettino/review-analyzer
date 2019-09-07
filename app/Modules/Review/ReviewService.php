<?php

namespace App\Modules\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Modules\Hotel\HotelService;
use App\Modules\Rule\RuleService;

use App\Modules\Review\Interfaces\ReviewServiceInterface;
use App\Modules\Review\Interfaces\ReviewRepositoryInterface;
use App\Modules\Hotel\Interfaces\HotelServiceInterface;
use App\Modules\Rule\Interfaces\RuleServiceInterface;

class ReviewService implements ReviewServiceInterface
{
    protected $reviewModel;
    protected $reviewRepositoryInterface;
    protected $hotelServiceInterface;
    protected $ruleServiceInterface;

    public function __construct(ReviewRepositoryInterface $reviewRepositoryInterface, HotelServiceInterface $hotelServiceInterface, RuleServiceInterface $ruleServiceInterface)
    {
        $this->reviewRepositoryInterface = $reviewRepositoryInterface;
        $this->hotelServiceInterface = $hotelServiceInterface;
        $this->ruleServiceInterface = $ruleServiceInterface;
    }

    // Add a hotel review
    public function create(array $data)
    {
        return $this->reviewRepositoryInterface->create($data);
    }

    // Delete a hotel review
    public function delete($id)
    {
        return $this->reviewRepositoryInterface->delete($id);
    }
}
