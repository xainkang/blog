<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //创建表的关联
    public $table='user';
    // 添加主键
    public $primaryKey='id';
    //是否允许批量操作
//    方法一：允许的字段
    //public $fillable=['username','password','email','phone'];
//     方法二：不允许的字段
    public $guarded=[];
    //    *没有不允许的字段，即：所有字段都允许

//是否维护create_at updated_at字段
     public $timestamps=false;

}

