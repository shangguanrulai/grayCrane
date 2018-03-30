<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configuration';

    public $primaryKey = 'config_id';

    protected $guarded = [];
}
