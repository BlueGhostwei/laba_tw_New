<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Eloquent;
class Category extends Eloquent
{
    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
                'name' => "required|max:20|unique:" . $this->getTable(),
                'media_id' => 'required',
            ],
        ];
    }

}
