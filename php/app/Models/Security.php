<?php

namespace App\Models;


use Eloquent;

class Security extends Eloquent
{
    protected  $table="security";
    /**
     * @var array
     * 验证字段完整性
     */
    protected $fillable = [
        'user_id',
        'ques_id',
        'answer',
    ];
    public function rules(){
        return [
            'create' => [
                'user_id' => "required|unique:".$this->getTable(),
                'ques_id' => 'required',
                'answer'>'required|min:2'
            ],
        ];
    }
}
