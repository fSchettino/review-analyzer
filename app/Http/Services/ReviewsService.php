<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Services\HotelsService;
use App\Http\Services\RulesService;

use App\Http\Interfaces\ReviewsServiceInterface;
use App\Http\Interfaces\ReviewRepositoryInterface;
use App\Http\Interfaces\HotelsServiceInterface;
use App\Http\Interfaces\RulesServiceInterface;

class ReviewsService implements ReviewsServiceInterface
{
    protected $reviewModel;
    protected $reviewRepositoryInterface;
    protected $hotelsServiceInterface;
    protected $rulesServiceInterface;

    public function __construct(ReviewRepositoryInterface $reviewRepositoryInterface, HotelsServiceInterface $hotelsServiceInterface, RulesServiceInterface $rulesServiceInterface)
    {
        $this->reviewRepositoryInterface = $reviewRepositoryInterface;
        $this->hotelsServiceInterface = $hotelsServiceInterface;
        $this->rulesServiceInterface = $rulesServiceInterface;
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
