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
    public function index(Request $request)
    {
//        $input=$request->all();
//        dd($input);
//        数据查询的方法
        $user=\App\Model\User::orderBy('id','asc')
            ->where (function ($query) use($request){
               $username=$request->input('username');
                $email=$request->input('email');
               if (!empty($username)){
                   $query->where('username','like','%'.$username.'%');
               }
                if (!empty($email)){
                    $query->where('email','like','%'.$email.'%');
                }
            })
        ->paginate($request->input('num')?$request->input('num'):3);
        return view('admin/user/list',compact('user','request'));
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
        //返回修改页面
       $user= \App\Model\User::find($id);
        return view('admin.user.edit',compact('user'));
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
        $input=$request->all();
        $user=\App\Model\User::find($id);
        $res=$user->update(['username'=>$input['username']]);
//    根据修改是否成功，跳转到对应的页面
        if ($res){
            $data=[
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'修改失败'
            ];
        }
        return $data;



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
