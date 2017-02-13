<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class UserGallery extends Eloquent
{
    //

    //use SoftDeletes;

    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'user_gallery';



    /**
     *
     *
     * @var array
     */
    protected $fillable = [
        'gallery_id',
        'status',
        'user_id',
        'reporter'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Wx_my_user::class, 'user_id');

    }


}
