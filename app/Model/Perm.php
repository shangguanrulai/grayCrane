<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class perm extends Model
{
    protected $table = 'permission';

    public $primaryKey = 'id';

    protected $guarded = [];
}
