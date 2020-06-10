<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>用户授权</title>
{{--    令牌环--}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
   @include('admin.public.script')
    @include('admin.public.styles')
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form" action="{{url('admin/role/doauth')}}" method="POST">
            {{csrf_field()}}
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>角色名</label>
                <div class="layui-input-inline">
                    <input type="hidden" name="role_id" value="{{$role->id}}">
                    <input type="text" id="L_username" name="role_name" value="{{$role->role_name}}" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>权限列表</label>
{{--                <div class="layui-input-inline">--}}
{{--                    <input type="text" id="L_username" name="role_name" required="" lay-verify="nikename" autocomplete="off" class="layui-input">--}}
{{--                  --}}
{{--                </div>--}}
                <div class="layui-input-block">
                    @foreach($permis as $v)
                        @if(in_array($v->id,$own_per))
                            <input type="checkbox" value="{{$v->id}}" name="permission_id[]" title="{{$v->per_name}}"  checked >
                        @else
                            <input type="checkbox" value="{{$v->id}}" name="permission_id[]" title="{{$v->per_name}}"  >
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

        });</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);


    })();</script>
</body>

</html>
