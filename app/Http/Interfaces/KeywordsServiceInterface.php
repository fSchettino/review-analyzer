<?php

namespace App\Http\Interfaces;

interface KeywordsServiceInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function edit(array $data, $id);

    public function delete($id);

    public function getKeywordsByType($type);
}
