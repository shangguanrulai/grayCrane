<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class perm_cate extends Model
{
    protected $table = 'perm_cate';

    public $primaryKey = 'id';

    protected $guarded = [];

    public $timestamps = false;

    public function perm()
    {
        return $this->hasMany('App\Model\Perm','pid','id');
    }
}
