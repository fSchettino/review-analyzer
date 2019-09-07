<?php

namespace App\Modules\Hotel\Interfaces;

use App\Modules\Shared\Interfaces\BaseInterface;

interface HotelServiceInterface extends BaseInterface
{
    public function all();

    public function find($id);
    
    public function create(array $data);

    public function edit(array $data, $id);

    public function delete($id);

    public function getAddViewHotelData();
}
