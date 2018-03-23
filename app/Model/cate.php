<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cate extends Model
{
    protected $table = 'cate';

    public $primaryKey = 'cid';

    protected $guarded = [];
}
