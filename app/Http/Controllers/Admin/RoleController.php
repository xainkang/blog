<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //权限列表处理
    public function doauth(Request $request){
        $input=$request->except('_token');
//        dd($input);
        //删除原来的role_permissiom表
        \DB::table('role_permission')->where('role_id',$input['role_id'])->delete();
        //重新添加role_permission表
        if (!empty($input['permission_id'])){
            foreach ($input['permission_id'] as $v){
                \DB::table('role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$v]);
            }
        }

return redirect('admin/role');


    }


    //获取授权页面
    public function auth($id){
        //获取当前角色
        $role=Role::find($id);
//        获取所有的权限列表
        $permis=Permission::get();
        //获取当前角色拥有的权限
        $own_pers=$role->permission;
        $own_per= [];
        foreach ($own_pers as $v){
            $own_per[] = $v->id;
        }
//        dd($own_per);
        return view('admin.role.auth',compact('role','permis','own_per'));

    }
    public function index()
    {
        //
        $role=Role::get();
        return view('admin.role.list',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $res=Role::create(['role_name'=>$request['role_name']]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role_id)
    {
        //

        $role=Role::find($role_id);
        return view('admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input=$request->all();
        $user=Role::find($id);
        $res=$user->update(['role_name'=>$input['role_name']]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user=Role::find($id);
        $res=$user->delete();
        if ($res){
            $data=[
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        return $data;
    }
}
