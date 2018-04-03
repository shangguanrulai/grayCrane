<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class collect extends Model
{
    //1.模型默认关联表
    public $table = 'collect';
    //2.模型默认的主键
    public $primarykey = 'id';
    //允许批量更新
    protected $fillable = ['status'];
    

    public function user_home()
    {
        return $this->belongsTo('App\Molde\user_home', 'uid', 'uid');
    }

    public function release()
    {
        return $this->belongsTo('App\Molde\collects', 'rid', 'rid');
    }

}