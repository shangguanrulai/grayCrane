<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public $primaryKey = 'oid';

    protected $guarded = [];

    public $timestamps = false;


}
