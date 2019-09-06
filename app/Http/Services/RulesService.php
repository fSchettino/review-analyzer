<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Interfaces\RulesServiceInterface;
use App\Http\Interfaces\RuleRepositoryInterface;
use App\Http\Interfaces\ServicesServiceInterface;
use App\Http\Interfaces\KeywordsServiceInterface;

class RulesService implements RulesServiceInterface
{
    protected $rulesRepositoryInterface;
    protected $servicesServiceInterface;
    protected $keywordsServiceInterface;

    public function __construct(RuleRepositoryInterface $ruleRepositoryInterface, ServicesServiceInterface $servicesServiceInterface, KeywordsServiceInterface $keywordsServiceInterface)
    {
        $this->ruleRepositoryInterface = $ruleRepositoryInterface;
        $this->servicesServiceInterface = $servicesServiceInterface;
        $this->keywordsServiceInterface = $keywordsServiceInterface;
    }

    // Get all rules and relations
    public function all()
    {
        return $this->ruleRepositoryInterface->all();
    }

    // Get rule by id
    public function find($id)
    {
        return $this->ruleRepositoryInterface->find($id);
    }

    // Add rule
    public function create(array $data)
    {
        return $this->ruleRepositoryInterface->create($data);
    }

    // Update rule
    public function edit(array $data, $id)
    {
        return $this->ruleRepositoryInterface->edit($data, $id);
    }

    // Delete rule
    public function delete($id)
    {
        return $this->ruleRepositoryInterface->delete($id);
    }

    // Get all information to render rule add view
    public function getAddViewRuleData()
    {
        $services = $this->servicesServiceInterface->all();
        $positiveKeywords = $this->keywordsServiceInterface->getKeywordsByType('positive');
        $negativeKeywords = $this->keywordsServiceInterface->getKeywordsByType('negative');
        return ['services' => $services, 'positiveKeywords' => $positiveKeywords, 'negativeKeywords' => $negativeKeywords];
    }
}
