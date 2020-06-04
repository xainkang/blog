<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use function foo\func;
use function Sodium\add;

class LoginController extends Controller
{
    //后台登录页
    public function login(){
        return view('admin.login');
    }
    //添加验证码
    public function code(){
        $code=new Code();
        return $code->make();
    }
   public function doLogin(Request $request){
      //  1.获取登录信息密码、用户名、验证码
       $input=$request->except('_token');
//       dd($input);

       $rule=[
           'username'=>'required|between:4,18',
           'password'=>'required|between:4,18|alpha_dash',
           'code'=>'required|between:4,4'
       ];

       $msg=[
           'username.required' => '用户名必须输入',
           'username.between' => '用户名必须在4-18位之间',
           'password.required' => '密码必须输入',
           'password.between' => '密码必须在4-18位之间',
           'password.alpha_dash' => '密码必须是数字字母下划线',
           'code.required' => '验证码必须输入',
           'code.between' => '验证码必须在4-18位之间'
       ];

       $validator =Validator::make($input,$rule,$msg);
       if($validator->fails()){
           return redirect('admin/login')
           ->withErrors($validator)
           ->withInput();
       }
//       3.验证用户（用户名，密码，验证码）
       $user=session()->get('code');
//       dd($user);
       if (strtolower($input['code'])!=strtolower($user)){
           return redirect('admin/login')->with('$errors','验证码错误');
       }
       $user=User::where('username',$input['username'])->first();
//        dd($user);
       if ($user == null){
           return redirect('admin/login')->with('$errors','用户名错误');
       }

       $crypt_jiami=$user->password;
       if (Crypt::decrypt($crypt_jiami)!=$input['password']){//decrypt:解密

           return  redirect('admin/login')->with('$errors','密码错误');
       }
//       4.保存用户信息到session中
       session()->put('user',$user);
//       5.跳转到后台首页

       return redirect('admin/index');


   }
   public function jiami(){
//        1.md5加密（生成32位的字符）
   $str='123456';
//   return md5($str);
//          2.哈希加密(生成64位字符)
//
//       $hash=Hash::make($str);
//       //哈希加密验证
//       if(Hash::check($str,$hash)){
//           return '密码正确';
//       }else{
//           return '密码错误';
//       }
//            3.crypt加密(生成255位字符)
    //   $crypt_str=Crypt::encrypt($str);

      // return $crypt_str;
//       加密验证
        $crypt_jiami='eyJpdiI6Iis3Tk1pTlowYjNxSUhVcmV4MWh6RkE9PSIsInZhbHVlIjoiTytXd0lrT1l4Rm4wV0k5cjJzQitGUT09IiwibWFjIjoiNzliY2ZjMTlmMTY3MGNkMzZiYzA1YTY1MjVlYTBlZDQ1ZTAxMmJmZjM4N2UzZDllYWI3NmIwZDNmNGU3MjdiNSJ9';
        if (Crypt::decrypt($crypt_jiami)==$str){//decrypt:解密
            return '密码正确';
        }else{
            return  '密码错误';
        }
    }
    //后台页面
    public function index(){
        return view('admin.index');
    }
    public  function  welcome(){
        return view('admin.welcome');
    }
    public  function  admin(){
        return view('layouts.admin');
    }
    //退出登录
    public function logout(){
        //清除登录信息
        session()->flush();
       return redirect('admin/login');
    }

    //用户列表
    public function list(){
        $user=User::get();
        return view('admin/user/list',compact('user'));

    }


}

