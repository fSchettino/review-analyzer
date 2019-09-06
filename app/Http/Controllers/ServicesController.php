<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Interfaces\ServicesServiceInterface;

class ServicesController extends Controller
{
    protected $servicesServiceInterface;

    public function __construct(ServicesServiceInterface $servicesServiceInterface)
    {
        $this->servicesServiceInterface = $servicesServiceInterface;
    }

    // Load index page with services list
    public function all()
    {
        $services = $this->servicesServiceInterface->all();
        return view('services.index', ['services' => $services]);
    }

    // Load add service page
    public function create(Request $request)
    {
        $data = ['name' => $request->name];

        if ($request->isMethod('get')) {
            return view('services.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->servicesServiceInterface->create($data);
            if ($insertResponse == 'Service inserted') {
                $services = $this->servicesServiceInterface->all();
                return redirect('services')->with('services', $services);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Load update service page
    public function edit(Request $request)
    {
        $serviceId = $request->id;
        $data = ['name' => $request->name];

        if ($request->isMethod('get')) {
            $service = $this->servicesServiceInterface->find($serviceId);
            return view('services.edit')->with('service', $service);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->servicesServiceInterface->edit($data, $serviceId);
            if ($updateResponse == 'Service updated') {
                $services = $this->servicesServiceInterface->all();
                return redirect('services')->with('services', $services);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete service and reload services list page
    public function delete($id)
    {
        $deleteResponse = $this->servicesServiceInterface->delete($id);
        if ($deleteResponse == 'Service deleted') {
            $services = $this->servicesServiceInterface->all();
            return redirect('services')->with('services', $services);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
