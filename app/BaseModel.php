<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
abstract class BaseModel extends Model
{
    protected $rules;

    protected $validator;

    public function getRules()
    {
        return $this->rules;
    }

    public function getValidator($data)
    {
        return Validator::make($data,$this->getRules());
    }
}
