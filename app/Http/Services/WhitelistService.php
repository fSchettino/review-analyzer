<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class WhitelistService
{
    public function getWhitelistKeywords()
    {
        $whitelistKeywords = [
            0 => ['id' => 1, 'name' => 'Good', 'weight' => '1',],
            1 => ['id' => 2, 'name' => 'Exelent', 'weight' => '1',],
            2 => ['id' => 3, 'name' => 'Awesome', 'weight' => '1',]
        ];
        return $whitelistKeywords;
    }

    public function show($id)
    {
        return 'Whitelist Keyword Details';
    }

    public function add()
    {
        return 'Whitelist Keyword Added';
    }

    public function edit($id)
    {
        return 'Whitelist Keyword Updated';
    }

    public function delete($id)
    {
        return 'Whitelist Keyword Deleted';
    }
}
