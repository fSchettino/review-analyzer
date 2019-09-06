<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Interfaces\HotelsServiceInterface;
use App\Http\Interfaces\HotelRepositoryInterface;
use App\Http\Interfaces\ServicesServiceInterface;
use App\Http\Interfaces\RulesServiceInterface;

class HotelsService implements HotelsServiceInterface
{
    protected $hotelRepositoryInterface;
    protected $servicesServiceInterface;
    protected $rulesServiceInterface;


    public function __construct(HotelRepositoryInterface $hotelRepositoryInterface, ServicesServiceInterface $servicesServiceInterface, RulesServiceInterface $rulesServiceInterface)
    {
        $this->hotelRepositoryInterface = $hotelRepositoryInterface;
        $this->servicesServiceInterface = $servicesServiceInterface;
        $this->rulesServiceInterface = $rulesServiceInterface;
    }

    // Get all hotels and relations
    public function all()
    {
        return $this->hotelRepositoryInterface->all();
    }

    // Get hotel by id
    public function find($id)
    {
        return $this->hotelRepositoryInterface->find($id);
    }

    // Add hotel
    public function create(array $data)
    {
        return $this->hotelRepositoryInterface->create($data);
    }

    // Update hotel
    public function edit(array $data, $id)
    {
        return $this->hotelRepositoryInterface->edit($data, $id);
    }

    // Delete hotel
    public function delete($id)
    {
        return $this->hotelRepositoryInterface->delete($id);
    }

    // Get all information to render hotel add view
    public function getAddViewHotelData()
    {
        $services = $this->servicesServiceInterface->all();
        $rules = $this->rulesServiceInterface->all();
        return ['services' => $services, 'rules' => $rules];
    }

    // Update hotel average score
    public function updateHotelScore($id)
    {
        $hotel = $this->hotelRepositoryInterface->find($id);

        $scoreSum = 0;
        $hotelScore = 0;
        $hotelReviewsCount = count($hotel->reviews);

        if (count($hotel->reviews) != 0) {
            foreach ($hotel->reviews as $review) {
                $scoreSum+= $review->score;
            }
            $hotelScore = $scoreSum/$hotelReviewsCount;
            $hotel->score = $hotelScore;
            $hotel->save();
        } else {
            $hotel->score = 0;
            $hotel->save();
        }
    }
}
