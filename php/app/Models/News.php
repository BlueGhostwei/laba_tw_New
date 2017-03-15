<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class News extends Eloquent
{

    /**
     * @var string
     * $table->string('media_id',100)->nullable()->commit('选择的媒体类型id');
     * $table->tinyInteger('Manuscripts_attr')->default(1)->commit('提交稿件类型');
     * $table->string('Manuscripts',50)->nulable()->commit('提交的外部稿件');
     * $table->char('url_line',80)->nullable()->commit('外部链接');
     * $table->longText('content')->nullable()->commit('内容');
     * $table->string('keyword',50)->nullable()->commit('关键字');
     * $table->integer('start_time')->commit('开始时间');
     * $table->integer('end_time')->commit('结束时间');
     * $table->string('remark',200)->nullable()->commit('备注');
     */
    //表名称
    protected $table = 'news';

    //数据完整性
    protected $fillable = [
        'user_id',
        'title',
        'media_id',
        'Manuscripts_attr',
        'Manuscripts',
        'url_line',
        'content',
        'keyword',
        'start_time',
        'end_time',
        'order_code',
        'status',
        'remark',
    ];
}
