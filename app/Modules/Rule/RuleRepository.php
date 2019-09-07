<?php

namespace App\Modules\Rule;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

use App\Modules\Rule\Rule;
use App\Modules\Rule\Interfaces\RuleRepositoryInterface;

class RuleRepository implements RuleRepositoryInterface
{
    protected $ruleModel;
    
    public function __construct(Rule $rule)
    {
        $this->ruleModel = $rule;
    }
    
    public function all()
    {
        return  $this->ruleModel->all()->load('keywords')->load('service');
    }
    
    public function find($id)
    {
        if (null == $rule = $this->ruleModel->find($id)->load('keywords')->load('service')) {
            throw new ModelNotFoundException('Service not found');
        }
    
        return $rule;
    }
    
    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $this->ruleModel->service_id = $data['service'];
            $this->ruleModel->name = $data['name'];
            $this->ruleModel->save();

            $positiveKeywords = $data['positiveKeywords'];
            $negativeKeywords = $data['negativeKeywords'];

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

    public function edit(array $data, $id)
    {
        try {
            DB::beginTransaction();
            $rule = $this->ruleModel->find($id);
            $rule->service_id = $data['service'];
            $rule->name = $data['name'];
            $rule->keywords()->detach();
            $rule->save();

            $positiveKeywords = $data['positiveKeywords'];
            $negativeKeywords = $data['negativeKeywords'];

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
}
