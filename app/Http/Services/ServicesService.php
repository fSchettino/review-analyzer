<?php

namespace App\Http\Services;

use App\Http\Models\Service;
use App\Http\Models\WhitelistKeyword;
use App\Http\Models\BlacklistKeyword;
use Illuminate\Http\Request;

class ServicesService
{
    protected $serviceModel;
    protected $whitelistModel;
    protected $blacklistModel;

    public function __construct()
    {
        $this->serviceModel = new Service();
        $this->whitelistModel = new WhitelistKeyword();
        $this->blacklistModel = new BlacklistKeyword();
    }

    public function getServicesList()
    {
        $whitelistKeywords = $this->whitelistModel->all();
        $blacklistKeywords = $this->blacklistModel->all();

        $services = [
             0 => ['id' => 1, 'name' => 'Service 1', 'reviews' => '15', 'avgScore' => '3.2', 'goodKeywords' => $whitelistKeywords, 'badKeywords' => $blacklistKeywords],
             1 => ['id' => 2, 'name' => 'Service 2', 'reviews' => '24', 'avgScore' => '2.1', 'goodKeywords' => $whitelistKeywords, 'badKeywords' => $blacklistKeywords],
             2 => ['id' => 3, 'name' => 'Service 3', 'reviews' => '18', 'avgScore' => '5.5', 'goodKeywords' => $whitelistKeywords, 'badKeywords' => $blacklistKeywords]
         ];
        
        
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
