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

    // Load index page with services list
    public function index()
    {
        $services = $this->servicesServiceClass->showAll();
        return view('services.index', ['services' => $services]);
    }

    // Load add service page
    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('services.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->servicesServiceClass->add($request);
            if ($insertResponse == 'Service inserted') {
                $services = $this->servicesServiceClass->showAll();
                return redirect('services')->with('services', $services);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Load update service page
    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $service = $this->servicesServiceClass->edit($request);
            return view('services.edit')->with('service', $service);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->servicesServiceClass->edit($request);
            if ($updateResponse == 'Service updated') {
                $services = $this->servicesServiceClass->showAll();
                return redirect('services')->with('services', $services);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete service and reload services list page
    public function delete($id)
    {
        $deleteResponse = $this->servicesServiceClass->delete($id);
        if ($deleteResponse == 'Service deleted') {
            $services = $this->servicesServiceClass->showAll();
            return redirect('services')->with('services', $services);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
