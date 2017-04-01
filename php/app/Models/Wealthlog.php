<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wealthlog extends Model
{
    //
    protected $table = 'wealthlog';

    protected $fillable = [
        'user_id',
        'username',
        'order_code',
        'maketime',
        'type',
        'title',
        'price',
        'money',
        'state'
    ];
}
