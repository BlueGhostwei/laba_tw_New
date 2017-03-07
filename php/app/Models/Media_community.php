<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Media_community extends Eloquent
{
    protected $table = 'media_community';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'media_type',
        'documents_type',
        'media_name',
        'network',
        'Entrance_level',
        'Entrance_form',
        'coverage',
        'channel',
        'principal',
        'mobile_number',
        'user_Eail',
        'user_QQ',
        'address',
        'Zip_code',
        'documents_img',
        'diagram_img',
        'Website_Description',
        'standard',
        'media_md5',
        'pf_price',
        'px_price',
        'mb_price',

    ];
    public function rules()
    {
        return [
            'media_rule'=>[
                "media_type"=>"required",
                "documents_type"=>"required",
                "media_name"=>"required|min:2|max:20|unique:".$this->getTable(),
                "network"=>"required",
                "Entrance_level"=>"required",
                "Entrance_form"=>"required",
                "coverage"=>"required",
                "channel"=>"required",
                "principal"=>"required|min:2",
                "user_Eail"=>"required|email",
                "user_QQ"=>"required",
                "address"=>"required",
                "Zip_code"=>"required",
                "documents_img"=>"required",
                "Website_Description"=>"required",
                "media_md5"=>"required",
                "diagram_img"=>"required",
                "pf_price"=>"required",
                "px_price"=>"required",
                "mb_price"=>"required",
            ],
            'media_update_rule'=>[
                "media_type"=>"required",
                "documents_type"=>"required",
                "media_name"=>"required|min:2|max:20",
                "network"=>"required",
                "Entrance_level"=>"required",
                "Entrance_form"=>"required",
                "coverage"=>"required",
                "channel"=>"required",
                "principal"=>"required|min:2",
                "user_Eail"=>"required|email",
                "user_QQ"=>"required",
                "address"=>"required",
                "Zip_code"=>"required",
                "documents_img"=>"required",
                "Website_Description"=>"required",
                "media_md5"=>"required",
                "pf_price"=>"required",
                "px_price"=>"required",
                "mb_price"=>"required",
            ]
        ];
    }
    /*public function category(){
        return $this->hasOne('App\category','media_id');
    }*/
}
