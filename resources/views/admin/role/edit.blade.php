<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
{{--    //令牌环--}}
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
        <form class="layui-form" >
        <input type="hidden" name="uid" value="{{$role->id}}">
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>角色</label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="role_name" value="{{$role->role_name}}" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>
        </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button class="layui-btn" lay-filter="add" lay-submit="">更新</button></div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;
            //监听提交
            form.on('submit(add)',
                function(data) {
                 var uid=$("input[name='uid']").val();
                    //发异步，把数据提交给php
                    $.ajax({
                        type:'PUT',
                        url:'/admin/role/'+uid,
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:data.field,
                        success:function(data){
                            // 弹层提示添加成功，并刷新父页面
                            console.log(data);
                            if(data.status == 0){
                                layer.alert(data.message,{icon:6},function(){
                                    parent.location.reload(true);
                                });
                            }else{
                                layer.alert(data.message,{icon:5});
                            }
                        },
                        error:function(){
                            //错误信息
                        }

                    });
                    return false;
                });

        });</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>
