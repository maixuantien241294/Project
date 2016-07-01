<?php

namespace App\models\backend\user;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='groups';
    public function User(){
        return $this->hasMany('App\models\backend\user\UserGroup','user_id');
    }
}
