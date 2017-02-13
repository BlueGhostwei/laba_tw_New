<?php

namespace App\Models;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

class UserGalleryPic extends Eloquent
{
    protected $table = 'user_gallery_pic';
    /***
     * 选择发布用户图片表
     *
     */
    public $fillable = [
        'user_id',//用户的ID
        'list_pic',//图片id
        'code_id',//文件编号
        'online',//是否发布，1为true，0为false
        'type',//图片类型
    ];
}
