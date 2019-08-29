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

    public function add()
    {
        return view('services.add');
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
