<?php

namespace App\Modules\Service\Interfaces;

use App\Modules\Shared\Interfaces\BaseInterface;

interface ServiceServiceInterface extends BaseInterface
{
    public function all();

    public function find($id);
    
    public function create(array $data);

    public function edit(array $data, $id);

    public function delete($id);
}
