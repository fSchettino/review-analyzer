<?php

namespace App\Http\Repositories;

use App\Http\Models\Hotel;
use App\Http\Interfaces\HotelRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class HotelRepository implements HotelRepositoryInterface
{
    protected $hotelModel;
    
    public function __construct(Hotel $hotel)
    {
        $this->hotelModel = $hotel;
    }
    
    public function all()
    {
        return $this->hotelModel->all()->sortByDesc("score")->load('services')->load('rules')->load('reviews');
    }
    
    public function find($id)
    {
        if (null == $hotel = $this->hotelModel->find($id)->load('services')->load('rules')->load('reviews')) {
            throw new ModelNotFoundException('Hotel not found');
        }
    
        return $hotel;
    }
    
    public function create(array $data)
    {
        // return $this->hotelModel->create($data);
        
        try {
            DB::beginTransaction();
            $this->hotelModel->name = $data['name'];
            $this->hotelModel->description = $data['description'];
            $this->hotelModel->rooms = $data['rooms'];
            $this->hotelModel->score = 0;
            $this->hotelModel->save();

            $services = $data['services'];
            $rules = $data['rules'];

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

    public function edit(array $data, $id)
    {
        // return $this->hotelModel->where('id', $id)
        //                         ->update($data);

        try {
            DB::beginTransaction();
            $hotel = $this->hotelModel->find($id);
            $hotel->name = $data['name'];
            $hotel->description = $data['description'];
            $hotel->rooms = $data['rooms'];
            $hotel->services()->detach();
            $hotel->rules()->detach();
            $hotel->save();

            $services = $data['services'];
            $rules = $data['rules'];

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
        // return $this->hotelModel->destroy($id);

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
}
