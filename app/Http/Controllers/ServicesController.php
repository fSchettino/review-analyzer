<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ServicesService;

class ServicesController extends Controller
{
    public function index()
    {
        $servicesServiceClass = new ServicesService();
        $services = $servicesServiceClass->getServicesList();
        return view('services.index', ['services' => $services]);
    }

    public function show($id)
    {
        return view('services.show');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {

            // Get all whitelist keywords
            $whitelistKeywords = [
                0 => ['id' => 1, 'name' => 'Good', 'weight' => '1',],
                1 => ['id' => 2, 'name' => 'Exelent', 'weight' => '1',],
                2 => ['id' => 3, 'name' => 'Awesome', 'weight' => '1',]
            ];

            // Get all blacklist keywords
            $blacklistKeywords = [
                0 => ['id' => 1, 'name' => 'Bad', 'weight' => '1',],
                1 => ['id' => 2, 'name' => 'Dreadful', 'weight' => '1',],
                2 => ['id' => 3, 'name' => 'Appalling', 'weight' => '1',]
            ];

            return view('services.add', ['whitelistKeywords' => $whitelistKeywords, 'blacklistKeywords' => $blacklistKeywords]);
        } elseif ($request->isMethod('post')) {
            $serviceData = $request->all();
            // $request->getParam('name');
            // $request->getParam('weight');
            $serviceServiceClass = new ServicesService();
            $services = $serviceServiceClass->getServicesList($serviceData);
            return view('services.index', ['services' => $services]);
        }
    }

    public function edit($id)
    {
        return view('services.edit');
    }

    public function delete($id)
    {
        return view('services.delete');
    }
}
