<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cate extends Model
{
    protected $table = 'cate';

    public $primaryKey = 'cid';

    protected $guarded = [];


    public static function tree()
    {
        //获取所需的分类数据
        $cates = self::orderBy('path','asc')->get();



        return self::getTree($cates,0,'pid');



    }

    //格式化 缩进和排序
    public static function  getTree($category,$pid=0,$cate_pid='cate_pid')
    {

//         声明一个空数组，存放格式化后的分类信息
        $arr = [];
//        获取所有的一级类，每次遍历获取一个一级类
        foreach ($category as $v){
            // 如果是一级类
            if($v->pid == $pid){
                $arr[] = $v;
                //再次遍历所有的分类，取出当前一级类下的二级类
                foreach ($category as $n){
                    if($v->cid == $n->pid){
                        $n->cname ='|-----'.$n->cname;
                        $arr[] = $n;
                    }
                }
            }
        }
        $arr = (object)$arr;
        return $arr;
    }

}
