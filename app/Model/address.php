<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table = 'address';

    public $primaryKey = 'aid';

    protected $guarded = [];

    public function user_home()
    {
        return $this->belongsTo('App\Model\address','uid','uid');
    }
}
