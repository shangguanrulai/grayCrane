<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_User extends Model
{
    //1.模型默认关联表
    public $table = 'user_admin';
    //2.模型默认的主键
    public $primarykey = 'id';
    //允许批量更新
    protected $fillable = ['status'];





}
