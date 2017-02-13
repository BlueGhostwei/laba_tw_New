<?php

namespace App\Models;

class UserObserver
{
    public function creating($model)
    {
        // 用户默认是加盟商身份
        if (!isset($model->role)) {
            $model->role = AclRole::ROLE_LEAGUE;
        }
         //dd(11111111);
        return $model;
    }

}
