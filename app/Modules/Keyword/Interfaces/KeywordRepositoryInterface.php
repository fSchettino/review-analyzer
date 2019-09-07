<?php

namespace App\Modules\Keyword\Interfaces;

use App\Modules\Shared\Interfaces\BaseInterface;

interface KeywordRepositoryInterface extends BaseInterface
{
    public function all();

    public function find($id);
    
    public function create(array $data);

    public function edit(array $data, $id);

    public function delete($id);
}
