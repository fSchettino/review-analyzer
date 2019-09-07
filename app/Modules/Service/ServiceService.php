<?php

namespace App\Modules\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Modules\Service\Interfaces\ServiceServiceInterface;
use App\Modules\Service\Interfaces\ServiceRepositoryInterface;

class ServiceService implements ServiceServiceInterface
{
    public function __construct(ServiceRepositoryInterface $serviceRepositoryInterface)
    {
        $this->serviceRepositoryInterface = $serviceRepositoryInterface;
    }

    // Get all services
    public function all()
    {
        return $services = $this->serviceRepositoryInterface->all();
    }

    // Get hotel by id
    public function find($id)
    {
        return $this->serviceRepositoryInterface->find($id);
    }

    // Add service
    public function create(array $data)
    {
        return $this->serviceRepositoryInterface->create($data);
    }

    // Update service
    public function edit(array $data, $id)
    {
        return $this->serviceRepositoryInterface->edit($data, $id);
    }

    // Delete service
    public function delete($id)
    {
        return $this->serviceRepositoryInterface->delete($id);
    }
}
