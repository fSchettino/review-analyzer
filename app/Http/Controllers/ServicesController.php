<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ServicesService;

class ServicesController extends Controller
{
    protected $servicesServiceClass;

    public function __construct()
    {
        $this->servicesServiceClass = new ServicesService();
    }

    public function index()
    {
        $services = $this->servicesServiceClass->showAll();
        return view('services.index', ['services' => $services]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('services.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->servicesServiceClass->add($request);
            if ($insertResponse == 'Service inserted') {
                $services = $this->servicesServiceClass->showAll();
                return view('services.index', ['services' => $services]);
            } else {
                return view('error')->with('error', $insertResponse);
            };
        }
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $service = $this->servicesServiceClass->edit($request);
            return view('services.edit')->with('service', $service);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->servicesServiceClass->edit($request);
            if ($updateResponse == 'Service updated') {
                $services = $this->servicesServiceClass->showAll();
                return view('services.index', ['services' => $services]);
            } else {
                return view('error')->with('error', $updateResponse);
            };
        }
    }

    public function delete($id)
    {
        $deleteResponse = $this->servicesServiceClass->delete($id);
        if ($deleteResponse == 'Service deleted') {
            $services = $this->servicesServiceClass->showAll();
            return view('services.index', ['services' => $services]);
        } else {
            return view('error')->with('error', $deleteResponse);
        };
    }
}
