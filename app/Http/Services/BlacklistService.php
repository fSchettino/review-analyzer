<?php

namespace App\Http\Services;

use App\Http\Models\BlacklistKeyword;
use Illuminate\Http\Request;

class BlacklistService
{
    protected $blacklistModel;

    public function __construct()
    {
        $this->blacklistModel = new BlacklistKeyword();
    }

    public function showAll()
    {
        //find all blacklist keywords
        $blacklistKeywords = $this->blacklistModel->all();
        return $blacklistKeywords;
    }

    public function add(Request $request)
    {
        try {
            $this->blacklistModel->name = $request->name;
            $this->blacklistModel->weight = $request->weight;
            $this->blacklistModel->save();
            return 'keyword inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $blacklistKeyword = $this->blacklistModel->find($request->id);
            return $blacklistKeyword;
        } elseif ($request->isMethod('post')) {
            try {
                $blacklistKeyword = $this->blacklistModel->find($request->id);
                $blacklistKeyword->name = $request->name;
                $blacklistKeyword->weight = $request->weight;
                $blacklistKeyword->save();
                return 'keyword updated';
            } catch (\Throwable $th) {
                return $th;
            }
        }
    }

    public function delete($id)
    {
        try {
            $this->blacklistModel->where('id', $id)->delete();
            return 'keyword deleted';
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
