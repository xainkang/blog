<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/user/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接受前台表单戴数据
        $input=$request->all();
        $username=$input['username'];
        $password=Crypt::encrypt($input['pass']);
//        $phone=$input['phone'];
        $email=$input['email'];
//        $aa=()



        $res=\App\Model\User::create(['username'=>$username,'password'=>$password,'email'=>$email]);
        if ($res){
            $data=[
                'status'=>0,
                'message'=>'添加成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'添加失败'
            ];
        }
        return $data;
        //进行表单验证
        //添加到数据库
//        根据添加是否成功，返回json格式数据
    }

    /**
     * 查询所有的数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
