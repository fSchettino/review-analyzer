<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Modules\Keyword\Interfaces\KeywordServiceInterface;

class KeywordController extends Controller
{
    protected $keywordServiceInterface;

    public function __construct(KeywordServiceInterface $keywordServiceInterface)
    {
        $this->keywordServiceInterface = $keywordServiceInterface;
    }

    // Load index page with keywords list
    public function all()
    {
        $keywords = $this->keywordServiceInterface->all();
        return view('keywords.index', ['keywords' => $keywords]);
    }

    // Load add keyword page
    public function create(Request $request)
    {
        $data = ['type' => $request->type, 'name' => $request->name, 'weight' => $request->weight];

        if ($request->isMethod('get')) {
            return view('keywords.add');
        } elseif ($request->isMethod('post')) {
            $insertResponse = $this->keywordServiceInterface->create($data);
            if ($insertResponse == 'Keyword inserted') {
                $keywords = $this->keywordServiceInterface->all();
                return redirect('keywords')->with('keywords', $keywords);
            } else {
                return redirect('error')->with('error', $insertResponse);
            };
        }
    }

    // Load update keyword page
    public function edit(Request $request)
    {
        $keywordId = $request->id;
        $data = ['type' => $request->type, 'name' => $request->name, 'weight' => $request->weight];

        if ($request->isMethod('get')) {
            $keyword = $this->keywordServiceInterface->find($keywordId);
            return view('keywords.edit')->with('keyword', $keyword);
        } elseif ($request->isMethod('post')) {
            $updateResponse = $this->keywordServiceInterface->edit($data, $keywordId);
            if ($updateResponse == 'Keyword updated') {
                $keywords = $this->keywordServiceInterface->all();
                return redirect('keywords')->with('keywords', $keywords);
            } else {
                return redirect('error')->with('error', $updateResponse);
            };
        }
    }

    // Delete keyword and reload keywords list page
    public function delete($id)
    {
        $deleteResponse = $this->keywordServiceInterface->delete($id);
        if ($deleteResponse == 'Keyword deleted') {
            $keywords = $this->keywordServiceInterface->all();
            return redirect('keywords')->with('keywords', $keywords);
        } else {
            return redirect('error')->with('error', $deleteResponse);
        };
    }
}
