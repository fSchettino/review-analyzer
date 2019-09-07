<?php

namespace App\Modules\Rule\Interfaces;

use App\Modules\Shared\Interfaces\BaseInterface;

interface RuleServiceInterface extends BaseInterface
{
    public function all();

    public function find($id);
    
    public function create(array $data);

    public function edit(array $data, $id);

    public function delete($id);

    public function getAddViewRuleData();
}
