<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RulesService;
use App\Http\Services\ServicesService;

class RulesController extends Controller
{
    protected $rulesServiceClass;
    protected $servicesServiceClass;

    public function __construct()
    {
        $this->rulesServiceClass = new RulesService();
        $this->servicesServiceClass = new ServicesService();
    }

    // Load index page with rules list
    public function index()
    {
        $rules = $this->rulesServiceClass->showAll();
        return view('rules.index', ['rules' => $rules]);
    }

    // Load add rule page
    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $getAddViewRuleData = $this->rulesServiceClass->getAddViewRuleData();
            return view('rules.add', ['services' => $getAddViewRuleData['services'], 'positiveKeywords' => $getAddViewRuleData['positiveKeywords'], 'negativeKeywords' => $getAddViewRuleData['negativeKeywords']]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->rulesServiceClass->add($request);
            if ($insertResponse == 'Rule inserted') {
                $rules = $this->rulesServiceClass->showAll();
                return redirect('rules')->with('rules', $rules);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Load update rule page
    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $getAddViewRuleData = $this->rulesServiceClass->getAddViewRuleData();
            $rule = $this->rulesServiceClass->show($request->id);
            return view('rules.edit', ['rule' => $rule, 'services' => $getAddViewRuleData['services'], 'positiveKeywords' => $getAddViewRuleData['positiveKeywords'], 'negativeKeywords' => $getAddViewRuleData['negativeKeywords']]);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->rulesServiceClass->edit($request);
            if ($updateResponse == 'Rule updated') {
                $rules = $this->rulesServiceClass->showAll();
                return redirect('rules')->with('rules', $rules);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete rule and reload rules list page
    public function delete($id)
    {
        $deleteResponse = $this->rulesServiceClass->delete($id);
        if ($deleteResponse == 'Rule deleted') {
            $rules = $this->rulesServiceClass->showAll();
            return redirect('rules')->with('rules', $rules);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
