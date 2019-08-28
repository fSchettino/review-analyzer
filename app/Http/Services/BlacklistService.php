<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class BlacklistService
{
    public function getBlacklistKeywords()
    {
        $blacklistKeywords = [
            0 => ['id' => 1, 'name' => 'Bad', 'weight' => '1',],
            1 => ['id' => 2, 'name' => 'Dreadful', 'weight' => '1',],
            2 => ['id' => 3, 'name' => 'Appalling', 'weight' => '1',]
        ];
        return $blacklistKeywords;
    }

    public function show($id)
    {
        return 'Blacklist Keyword Details';
    }

    public function add()
    {
        return 'Blacklist Keyword Added';
    }

    public function edit($id)
    {
        return 'Blacklist Keyword Updated';
    }

    public function delete($id)
    {
        return 'Blacklist Keyword Deleted';
    }
}
