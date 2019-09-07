<?php

namespace App\Modules\Keyword;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

use App\Modules\Keyword\Keyword;
use App\Modules\Keyword\Interfaces\KeywordRepositoryInterface;

class KeywordRepository implements KeywordRepositoryInterface
{
    protected $keywordModel;
    
    public function __construct(Keyword $keyword)
    {
        $this->keywordModel = $keyword;
    }
    
    public function all()
    {
        return $keywords = $this->keywordModel->all();
    }
    
    public function find($id)
    {
        if (null == $keyword = $this->keywordModel->find($id)) {
            throw new ModelNotFoundException('Hotel not found');
        }
    
        return $keyword;
    }
    
    public function create(array $data)
    {
        // return $this->keywordModel->create($data);
        
        try {
            $this->keywordModel->type = $data['type'];
            $this->keywordModel->name = $data['name'];
            $this->keywordModel->weight = $data['weight'];
            $this->keywordModel->save();
            return 'Keyword inserted';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function edit(array $data, $id)
    {
        // return $this->keywordModel->where('id', $id)
        //                         ->update($data);

        try {
            $keyword = $this->keywordModel->find($id);
            $keyword->type = $data['type'];
            $keyword->name = $data['name'];
            $keyword->weight = $data['weight'];
            $keyword->save();
            return 'Keyword updated';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function delete($id)
    {
        // return $this->keywordModel->destroy($id);

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
        $keywords = $this->keywordModel->all()->where('type', $type);
        return $keywords;
    }
}
