<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class user_home extends Model
{
    protected $table = 'user_home';

    public $primaryKey = 'uid';

   public function userinfo_home()
   {
       return $this->hasOne('App\Model\userinfo_home','uid','uid');
   }

    public function release()
    {
        return $this->hasMany('App\Model\release', 'uid', 'uid');
    }

}
