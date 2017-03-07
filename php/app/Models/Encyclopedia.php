<?php

namespace App\Models;

use Eloquent;

class Encyclopedia extends Eloquent
{
    /**
     * @var string
     * 表名称
     */
    protected  $table="createEncyclopedia";
    /**
     * @var array
     * 验证完整性
     * 媒体(media_id) 来源分类(source_category) 主题（theme） 描述（description），内容：content
     */
    protected $fillable = [
        'media_id',
        'source_category',
        'description',
        'content'
    ];

    /**
     *验证规则
     */
    public function rules(){
        return [
            'create'=>[
                
            ],
        ];
    }
}
