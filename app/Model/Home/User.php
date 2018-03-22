<?php


namespace App\Model\Home;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
 
    public $table = 'user_home';

//    定义关联表的主键
    public $primaryKey = 'id';
    

    protected $fillable = ['username', 'password'];

}
 