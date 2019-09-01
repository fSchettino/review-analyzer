<?php

namespace App\Http\Services;

use App\Http\Models\Rule;
use App\Http\Services\ServicesService;
use App\Http\Services\KeywordsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RulesService
{
    protected $ruleModel;
    protected $servicesServiceClass;
    protected $keywordsServiceClass;

    public function __construct()
    {
        $this->ruleModel = new Rule();
        $this->servicesServiceClass = new ServicesService();
        $this->keywordsServiceClass = new KeywordsService();
    }

    public function showAll()
    {
        $rules = $this->ruleModel->all()->load('keywords')->load('service');
        return $rules;
    }

    public function show($id)
    {
        $rule = $this->ruleModel->find($id)->load('keywords')->load('service');
        return $rule;
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->ruleModel->service_id = $request->service;
            $this->ruleModel->name = $request->name;
            $this->ruleModel->save();

            $positiveKeywords = $request->positiveKeywords;
            $negativeKeywords = $request->negativeKeywords;

            if (!$positiveKeywords==null) {
                foreach ($positiveKeywords as $positiveKeyword) {
                    $this->ruleModel->keywords()->attach($positiveKeyword);
                };
            };

            if (!$negativeKeywords==null) {
                foreach ($negativeKeywords as $negativeKeyword) {
                    $this->ruleModel->keywords()->attach($negativeKeyword);
                };
            };
            DB::commit();

            return 'Rule inserted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function edit(Request $request)
    {
        try {
            DB::beginTransaction();
            $rule = $this->ruleModel->find($request->id);
            $rule->service_id = $request->service;
            $rule->name = $request->name;
            $rule->keywords()->detach();
            $rule->save();

            $positiveKeywords = $request->positiveKeywords;
            $negativeKeywords = $request->negativeKeywords;

            if (!$positiveKeywords==null) {
                foreach ($positiveKeywords as $positiveKeyword) {
                    $rule->keywords()->attach($positiveKeyword);
                };
            };

            if (!$negativeKeywords==null) {
                foreach ($negativeKeywords as $negativeKeyword) {
                    $rule->keywords()->attach($negativeKeyword);
                };
            };
            DB::commit();

            return 'Rule updated';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $rule = $this->ruleModel->find($id);
            $rule->keywords()->detach();
            $rule->delete();
            DB::commit();

            return 'Rule deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    public function getAddViewRuleData()
    {
        $services = $this->servicesServiceClass->showAll();
        $positiveKeywords = $this->keywordsServiceClass->getKeywordsByType('positive');
        $negativeKeywords = $this->keywordsServiceClass->getKeywordsByType('negative');
        return ['services' => $services, 'positiveKeywords' => $positiveKeywords, 'negativeKeywords' => $negativeKeywords];
    }
}
