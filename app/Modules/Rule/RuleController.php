<?php

namespace App\Modules\Rule;

use Illuminate\Http\Request;

use App\Modules\Rule\Interfaces\RuleServiceInterface;
use App\Modules\Service\Interfaces\ServiceServiceInterface;

class RuleController extends Controller
{
    protected $ruleServiceInterface;
    protected $serviceServiceInterface;

    public function __construct(RuleServiceInterface $ruleServiceInterface, ServiceServiceInterface $serviceServiceInterface)
    {
        $this->ruleServiceInterface = $ruleServiceInterface;
        $this->serviceServiceInterface = $serviceServiceInterface;
    }

    // Load index page with rules list
    public function all()
    {
        $rules = $this->ruleServiceInterface->all();
        return view('rules.index', ['rules' => $rules]);
    }

    // Load add rule page
    public function create(Request $request)
    {
        $data = ['name' => $request->name, 'service' => $request->service, 'positiveKeywords' => $request->positiveKeywords, 'negativeKeywords' => $request->negativeKeywords];
        
        if ($request->isMethod('get')) {
            $getAddViewRuleData = $this->ruleServiceInterface->getAddViewRuleData();
            return view('rules.add', ['services' => $getAddViewRuleData['services'], 'positiveKeywords' => $getAddViewRuleData['positiveKeywords'], 'negativeKeywords' => $getAddViewRuleData['negativeKeywords']]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->ruleServiceInterface->create($data);
            if ($insertResponse == 'Rule inserted') {
                $rules = $this->ruleServiceInterface->all();
                return redirect('rules')->with('rules', $rules);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Load update rule page
    public function edit(Request $request)
    {
        $ruleId = $request->id;
        $data = ['name' => $request->name, 'service' => $request->service, 'positiveKeywords' => $request->positiveKeywords, 'negativeKeywords' => $request->negativeKeywords];

        if ($request->isMethod('get')) {
            $getAddViewRuleData = $this->ruleServiceInterface->getAddViewRuleData();
            $rule = $this->ruleServiceInterface->find($ruleId);
            return view('rules.edit', ['rule' => $rule, 'services' => $getAddViewRuleData['services'], 'positiveKeywords' => $getAddViewRuleData['positiveKeywords'], 'negativeKeywords' => $getAddViewRuleData['negativeKeywords']]);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->ruleServiceInterface->edit($data, $ruleId);
            if ($updateResponse == 'Rule updated') {
                $rules = $this->ruleServiceInterface->all();
                return redirect('rules')->with('rules', $rules);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete rule and reload rules list page
    public function delete($id)
    {
        $deleteResponse = $this->ruleServiceInterface->delete($id);
        if ($deleteResponse == 'Rule deleted') {
            $rules = $this->ruleServiceInterface->all();
            return redirect('rules')->with('rules', $rules);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
