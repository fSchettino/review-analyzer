<?php

namespace App\Http\Services;

use App\Http\Models\Hotel;
use App\Http\Services\ServicesService;
use App\Http\Services\RulesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelsService
{
    protected $hotelModel;
    protected $servicesServiceClass;
    protected $rulesServiceClass;

    public function __construct()
    {
        $this->hotelModel = new Hotel();
        $this->servicesServiceClass = new ServicesService();
        $this->rulesServiceClass = new RulesService();
    }

    public function showAll()
    {
        $hotels = $this->hotelModel->all()->sortByDesc("score")->load('services')->load('rules');
        return $hotels;
    }

    public function show($id)
    {
        $hotel = $this->hotelModel->find($id);
        $hotel->load('services')->load('rules')->load('reviews');
        return $hotel;
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->hotelModel->name = $request->name;
            $this->hotelModel->description = $request->description;
            $this->hotelModel->rooms = $request->rooms;
            $this->hotelModel->score = 0;
            $this->hotelModel->save();

            $services = $request->services;
            $rules = $request->rules;

            if (!$services==null) {
                foreach ($services as $service) {
                    $this->hotelModel->services()->attach($service);
                };
            };

            if (!$rules==null) {
                foreach ($rules as $rule) {
                    $this->hotelModel->rules()->attach($rule);
                };
            };
            DB::commit();

            return 'Hotel inserted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $hotel = $this->hotelModel->find($request->id);
            $hotel->name = $request->name;
            $hotel->description = $request->description;
            $hotel->rooms = $request->rooms;
            $hotel->services()->detach();
            $hotel->rules()->detach();
            $hotel->save();

            $services = $request->services;
            $rules = $request->rules;

            if (!$services==null) {
                foreach ($services as $service) {
                    $hotel->services()->attach($service);
                };
            };

            if (!$rules==null) {
                foreach ($rules as $rule) {
                    $hotel->rules()->attach($rule);
                };
            };
            DB::commit();

            return 'Hotel updated';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $hotel = $this->hotelModel->find($id);
            $hotel->services()->detach();
            $hotel->rules()->detach();
            $hotel->reviews()->delete();
            $hotel->delete();
            DB::commit();

            return 'Hotel deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function getAddViewHotelData()
    {
        $services = $this->servicesServiceClass->showAll();
        $rules = $this->rulesServiceClass->showAll();
        return ['services' => $services, 'rules' => $rules];
    }

    public function updateHotelScore($id)
    {
        $hotel = $this->hotelModel->find($id);
        $hotel->load('reviews');

        $reviewsCount = count($hotel->reviews);
        $scoreSum = 0;
        $hotelScore = 0;

        foreach ($hotel->reviews as $review) {
            $scoreSum+= $review->score;
        }

        $hotelScore = $scoreSum/$reviewsCount;
        $hotel->score = $hotelScore;
        $hotel->save();
    }
}
