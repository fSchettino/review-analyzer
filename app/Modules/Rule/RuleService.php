<?php

namespace App\Modules\Rule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Modules\Rule\Interfaces\RuleServiceInterface;
use App\Modules\Rule\Interfaces\RuleRepositoryInterface;
use App\Modules\Service\Interfaces\ServiceServiceInterface;
use App\Modules\Keyword\Interfaces\KeywordServiceInterface;

class RuleService implements RuleServiceInterface
{
    protected $rulesRepositoryInterface;
    protected $serviceServiceInterface;
    protected $keywordServiceInterface;

    public function __construct(RuleRepositoryInterface $ruleRepositoryInterface, ServiceServiceInterface $serviceServiceInterface, KeywordServiceInterface $keywordServiceInterface)
    {
        $this->ruleRepositoryInterface = $ruleRepositoryInterface;
        $this->serviceServiceInterface = $serviceServiceInterface;
        $this->keywordServiceInterface = $keywordServiceInterface;
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
        $services = $this->serviceServiceInterface->all();
        $positiveKeywords = $this->keywordServiceInterface->getKeywordsByType('positive');
        $negativeKeywords = $this->keywordServiceInterface->getKeywordsByType('negative');
        return ['services' => $services, 'positiveKeywords' => $positiveKeywords, 'negativeKeywords' => $negativeKeywords];
    }
}
