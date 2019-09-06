<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Interfaces\RulesServiceInterface;
use App\Http\Interfaces\ServicesServiceInterface;

class RulesController extends Controller
{
    protected $rulesServiceInterface;
    protected $servicesServiceInterface;

    public function __construct(RulesServiceInterface $rulesServiceInterface, ServicesServiceInterface $servicesServiceInterface)
    {
        $this->rulesServiceInterface = $rulesServiceInterface;
        $this->servicesServiceInterface = $servicesServiceInterface;
    }

    // Load index page with rules list
    public function all()
    {
        $rules = $this->rulesServiceInterface->all();
        return view('rules.index', ['rules' => $rules]);
    }

    // Load add rule page
    public function create(Request $request)
    {
        $data = ['name' => $request->name, 'service' => $request->service, 'positiveKeywords' => $request->positiveKeywords, 'negativeKeywords' => $request->negativeKeywords];
        
        if ($request->isMethod('get')) {
            $getAddViewRuleData = $this->rulesServiceInterface->getAddViewRuleData();
            return view('rules.add', ['services' => $getAddViewRuleData['services'], 'positiveKeywords' => $getAddViewRuleData['positiveKeywords'], 'negativeKeywords' => $getAddViewRuleData['negativeKeywords']]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->rulesServiceInterface->create($data);
            if ($insertResponse == 'Rule inserted') {
                $rules = $this->rulesServiceInterface->all();
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
            $getAddViewRuleData = $this->rulesServiceInterface->getAddViewRuleData();
            $rule = $this->rulesServiceInterface->find($ruleId);
            return view('rules.edit', ['rule' => $rule, 'services' => $getAddViewRuleData['services'], 'positiveKeywords' => $getAddViewRuleData['positiveKeywords'], 'negativeKeywords' => $getAddViewRuleData['negativeKeywords']]);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->rulesServiceInterface->edit($data, $ruleId);
            if ($updateResponse == 'Rule updated') {
                $rules = $this->rulesServiceInterface->all();
                return redirect('rules')->with('rules', $rules);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete rule and reload rules list page
    public function delete($id)
    {
        $deleteResponse = $this->rulesServiceInterface->delete($id);
        if ($deleteResponse == 'Rule deleted') {
            $rules = $this->rulesServiceInterface->all();
            return redirect('rules')->with('rules', $rules);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
