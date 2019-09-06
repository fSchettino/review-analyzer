<?php

namespace App\Http\Interfaces;

interface ReviewRepositoryInterface
{
    public function create(array $data);

    public function delete($id);
}
