<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Interfaces\KeywordsServiceInterface;
use App\Http\Interfaces\KeywordRepositoryInterface;

class KeywordsService implements KeywordsServiceInterface
{
    protected $keywordRepositoryInterface;

    public function __construct(KeywordRepositoryInterface $keywordRepositoryInterface)
    {
        $this->keywordRepositoryInterface = $keywordRepositoryInterface;
    }

    // Get all keywords
    public function all()
    {
        return $this->keywordRepositoryInterface->all();
    }

    // Get keyword by id
    public function find($id)
    {
        return $this->keywordRepositoryInterface->find($id);
    }

    // Add keyword
    public function create(array $data)
    {
        return $this->keywordRepositoryInterface->create($data);
    }

    // Update keyword
    public function edit(array $data, $id)
    {
        return $this->keywordRepositoryInterface->edit($data, $id);
    }

    // Delete keyword
    public function delete($id)
    {
        return $this->keywordRepositoryInterface->delete($id);
    }

    // Get keywords by type (positive|negative)
    public function getKeywordsByType($type)
    {
        return $this->keywordRepositoryInterface->getKeywordsByType($type);
    }
}
