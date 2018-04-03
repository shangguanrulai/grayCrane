<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //1.模型默认关联表
    public $table = 'release';
    //2.模型默认的主键
    public $primarykey = 'rid';
    //3.允许批量更新
    protected $fillable = [''];
	//4.是否自动添加created_at,update_at
	public $timestamps = false;



}
