<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modules\Service\Interfaces\ServiceServiceInterface;

class ServiceController extends Controller
{
    protected $serviceServiceInterface;

    public function __construct(ServiceServiceInterface $serviceServiceInterface)
    {
        $this->serviceServiceInterface = $serviceServiceInterface;
    }

    // Load index page with services list
    public function all()
    {
        $services = $this->serviceServiceInterface->all();
        return view('services.index', ['services' => $services]);
    }

    // Load add service page
    public function create(Request $request)
    {
        $data = ['name' => $request->name];

        if ($request->isMethod('get')) {
            return view('services.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->serviceServiceInterface->create($data);
            if ($insertResponse == 'Service inserted') {
                $services = $this->serviceServiceInterface->all();
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
            $service = $this->serviceServiceInterface->find($serviceId);
            return view('services.edit')->with('service', $service);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->serviceServiceInterface->edit($data, $serviceId);
            if ($updateResponse == 'Service updated') {
                $services = $this->serviceServiceInterface->all();
                return redirect('services')->with('services', $services);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete service and reload services list page
    public function delete($id)
    {
        $deleteResponse = $this->serviceServiceInterface->delete($id);
        if ($deleteResponse == 'Service deleted') {
            $services = $this->serviceServiceInterface->all();
            return redirect('services')->with('services', $services);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
