<?php

namespace App\models\backend;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='users';
    public function group(){
        return $this->belongsToMany('App\models\backend\user\UserGroup','group_id');
    }
}
