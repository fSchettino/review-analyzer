<?php

namespace App\Modules\Review\Interfaces;

interface ReviewRepositoryInterface
{
    public function create(array $data);

    public function delete($id);
}
