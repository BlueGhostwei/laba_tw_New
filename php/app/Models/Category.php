<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'num',
        'media_id'//媒体类型：新闻发布，论坛等
    ];

    /**
     * 数据验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            'create' => [
                'name' => "required|min:3|max:20|unique:" . $this->getTable(),
                'media_id' => 'required',
                'status' => 'required',
                'num' => "required"
            ]
        ];
    }

}
