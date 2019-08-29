<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class ServicesService
{
    public function getServicesList()
    {
        $services = [
             0 => ['id' => 1, 'name' => 'Service 1', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']],
             1 => ['id' => 2, 'name' => 'Service 2', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']],
             2 => ['id' => 3, 'name' => 'Service 3', 'goodKeywords' => ['good', 'exelent', 'awesome'], 'badKeywords' => ['bad', 'dreadful', 'appalling']]
         ];

        /* $services = [
            0 => ['id' => 1, 'name' => 'Service 1', 'goodKeywords' => 'awesome', 'badKeywords' => 'dreadful'],
            1 => ['id' => 2, 'name' => 'Service 2', 'goodKeywords' => 'awesome', 'badKeywords' => 'dreadful'],
            2 => ['id' => 3, 'name' => 'Service 3', 'goodKeywords' => 'awesome', 'badKeywords' => 'dreadful']
        ]; */

        return $services;
    }

    public function show($id)
    {
        return 'Service Details';
    }

    public function add()
    {
        return 'Service Added';
    }

    public function edit($id)
    {
        return 'Service Updated';
    }

    public function delete($id)
    {
        return 'Service Deleted';
    }
}
