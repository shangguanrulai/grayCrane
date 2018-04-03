<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class userinfo_home extends Model
{
    protected $table = 'userinfo_home';

    public $primaryKey = 'id';

    protected $guarded = [];

    public function user_home()
    {
        return $this->belongsTo('App\Model\userinfo_home','uid','uid');
    }

}
