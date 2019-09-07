<?php

namespace App\Modules\Review\Interfaces;

interface ReviewServiceInterface
{
    public function create(array $data);

    public function delete($id);
}
