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

    public function index()
    {
        $rules = $this->rulesServiceClass->showAll();
        return view('rules.index', ['rules' => $rules]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('get')) {
            $getAddViewRuleData = $this->rulesServiceClass->getAddViewRuleData();
            return view('rules.add', ['services' => $getAddViewRuleData['services'], 'positiveKeywords' => $getAddViewRuleData['positiveKeywords'], 'negativeKeywords' => $getAddViewRuleData['negativeKeywords']]);
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->rulesServiceClass->add($request);
            if ($insertResponse == 'Rule inserted') {
                $rules = $this->rulesServiceClass->showAll();
                return view('rules.index', ['rules' => $rules]);
            } else {
                return view('error')->with('error', $insertResponse);
            };
        }
    }

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
                return view('rules.index', ['rules' => $rules]);
            } else {
                return view('error')->with('error', $updateResponse);
            };
        }
    }

    public function delete($id)
    {
        $deleteResponse = $this->rulesServiceClass->delete($id);
        if ($deleteResponse == 'Rule deleted') {
            $rules = $this->rulesServiceClass->showAll();
            return view('rules.index', ['rules' => $rules]);
        } else {
            return view('error')->with('error', $deleteResponse);
        };
    }
}
