<?php

namespace App\Http\Interfaces;

interface ReviewsServiceInterface
{
    public function create(array $data);

    public function delete($id);
}
