<?php

namespace App\Http\Services;

use App\Http\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeywordsService
{
    protected $keywordModel;

    public function __construct()
    {
        $this->keywordModel = new Keyword();
    }

    // Get all keywords
    public function showAll()
    {
        $keywords = $this->keywordModel->all();
        return $keywords;
    }

    // Add keyword
    public function add(Request $request)
    {
        try {
            $this->keywordModel->type = $request->type;
            $this->keywordModel->name = $request->name;
            $this->keywordModel->weight = $request->weight;
            $this->keywordModel->save();
            return 'Keyword inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    // Update keyword
    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $keyword = $this->keywordModel->find($request->id);
            return $keyword;
        } elseif ($request->isMethod('post')) {
            try {
                $keyword = $this->keywordModel->find($request->id);
                $keyword->type = $request->type;
                $keyword->name = $request->name;
                $keyword->weight = $request->weight;
                $keyword->save();
                return 'Keyword updated';
            } catch (\Throwable $th) {
                return $th;
            }
        }
    }

    // Delete keyword
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $keyword = $this->keywordModel->find($id);
            $keyword->rules()->detach();
            $keyword->delete();
            DB::commit();

            return 'Keyword deleted';
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }

    // Get keywords by type (positive|negative)
    public function getKeywordsByType($type)
    {
        $keywords = $this->keywordModel::all()->where('type', $type);
        return $keywords;
    }
}
