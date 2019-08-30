<?php

namespace App\Http\Services;

use App\Http\Models\WhitelistKeyword;
use Illuminate\Http\Request;

class WhitelistService
{
    protected $whitelistModel;

    public function __construct()
    {
        $this->whitelistModel = new WhitelistKeyword();
    }

    public function showAll()
    {
        //find all whitelist keywords
        $whitelistKeywords = $this->whitelistModel->all();
        return $whitelistKeywords;
    }

    public function add(Request $request)
    {
        try {
            $this->whitelistModel->name = $request->name;
            $this->whitelistModel->weight = $request->weight;
            $this->whitelistModel->save();
            return 'keyword inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('get')) {
            $whitelistKeyword = $this->whitelistModel->find($request->id);
            return $whitelistKeyword;
        } elseif ($request->isMethod('post')) {
            try {
                $whitelistKeyword = $this->whitelistModel->find($request->id);
                $whitelistKeyword->name = $request->name;
                $whitelistKeyword->weight = $request->weight;
                $whitelistKeyword->save();
                return 'keyword updated';
            } catch (\Throwable $th) {
                return $th;
            }
        }
    }

    public function delete($id)
    {
        try {
            $this->whitelistModel->where('id', $id)->delete();
            return 'keyword deleted';
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
