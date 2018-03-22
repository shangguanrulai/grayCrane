<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class release extends Model
{
    protected $table = 'release';

    public $primaryKey = 'rid';

    public function user_home()
    {
        return $this->belongsTo('App\Molde\user_home', 'uid', 'uid');
    }
}
