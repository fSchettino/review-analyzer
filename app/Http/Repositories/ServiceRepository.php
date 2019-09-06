<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

use App\Http\Models\Service;
use App\Http\Interfaces\ServiceRepositoryInterface;

class ServiceRepository implements ServiceRepositoryInterface
{
    protected $serviceModel;
    
    public function __construct(Service $service)
    {
        $this->serviceModel = $service;
    }
    
    public function all()
    {
        return  $this->serviceModel->all();
    }
    
    public function find($id)
    {
        if (null == $service = $this->serviceModel->find($id)) {
            throw new ModelNotFoundException('Service not found');
        }
    
        return $service;
    }
    
    public function create(array $data)
    {
        try {
            $this->serviceModel->name = $data['name'];
            $this->serviceModel->save();
            return 'Service inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit(array $data, $id)
    {
        try {
            $service = $this->serviceModel->find($id);
            $service->name = $data['name'];
            $service->save();
            return 'Service updated';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $service = $this->serviceModel->find($id);
            $rules = $service->load('rules');
            foreach ($service->rules as $rule) {
                $serviceRule = $this->ruleModel->find($rule->id);
                $serviceRule->keywords()->detach();
                $serviceRule->delete();
            }
            $service->delete();
            DB::commit();
            
            return 'Service deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
