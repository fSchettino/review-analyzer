<?php

namespace App\Http\Services;

use App\Http\Models\Service;
use App\Http\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesService
{
    protected $serviceModel;
    protected $ruleModel;

    public function __construct()
    {
        $this->serviceModel = new Service();
        $this->ruleModel = new Rule();
    }

    public function showAll()
    {
        $services = $this->serviceModel->all();
        return $services;
    }

    public function add(Request $request)
    {
        try {
            $this->serviceModel->name = $request->name;
            $this->serviceModel->save();
            return 'Service inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $service = $this->serviceModel->find($request->id);
            return $service;
        } elseif ($request->isMethod('post')) {
            try {
                $service = $this->serviceModel->find($request->id);
                $service->name = $request->name;
                $service->save();
                return 'Service updated';
            } catch (\Throwable $th) {
                return $th;
            }
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
