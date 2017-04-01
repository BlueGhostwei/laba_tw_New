<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'message';
    protected $fillable =[
        'title',
        'message',
        'author',
        'receive'
    ];
    public function read(){
        $this->read = 1;
    }
}
