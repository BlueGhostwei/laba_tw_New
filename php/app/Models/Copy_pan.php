<?php

namespace App\Models;

use Eloquent;

class Copy_pan extends Eloquent
{

    /**
     * @var string
     * 表结构
     */
    protected $table = "copy_pan";
    /**
     * @var array
     * 维护数据完整性
     * user_id 用户id
     *  'text_type'，文章类型
     * 'content',内容
     * 'number',字数
     * 'cycle',周期
     * 'article_price'价格
     * article_num 篇数
     */
    protected $fillable = [
        'title',
        'user_id',
        'text_type',
        'content',
        'number',
        'cycle',
        'article_price',
        'article_num'
    ];

    /**
     * @return array
     *
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'text_type' => "required",
            'content' => "required",
            'number' => "required",
            'cycle' => "required",
            'article_num' => "required",
            'article_price' => "required",
        ];
    }
}
