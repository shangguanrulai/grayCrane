<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
    //1.模型默认关联表
    public $table = 'words';
    //2.模型默认的主键
    public $primarykey = 'wid';
    //允许批量更新
    protected $fillable = [];

    public function release()
    {
        return $this->belongsTo('App\Molde\release', 'rid', 'rid');
    }

}