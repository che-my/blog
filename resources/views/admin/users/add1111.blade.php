@extends('admin.app')
@section('content-header')
    <ol class="breadcrumb">
        <li><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">用户管理 -  用户列表</li>
    </ol>
    <h1>
        用户管理
        <small><a href="/admin/users" class="btn btn-success">用户列表</a></small>
    </h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">用户添加</h3>
        </div>
        <div class="box-body table-responsive">
            <div class="col-lg-6">
            <form action="/admin/users/insert" method="get">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">用户名</span>
                    <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">邮箱</span>
                    <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">密码</span>
                    <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">确认密码</span>
                    <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                </div>
            </form>
            </div>
        </div>
    </div>
<!-- 脚本文件 -->
<script src="//cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>
<script src="/dist/layer/2.4/layer.js"></script>
<script>
//删除单条数据
function del(id){
    obj = $("a[delname="+id+"]");
    layer.confirm('确认要删除吗',function(index){
        $.get("/admin/users/delete",{id:id},function(data){
            if(data){
                $(obj).parents("tr").remove();
                layer.msg('删除数据成功!',{icon: 1,time:1000});
            }
        });
    });
}


// 全选
function checkAll(){
    $(".dels").find("tr").each(function(){
        $(this).find(":checkbox").prop("checked", true).attr("checked",true);
    })
}
//全不选
function checkAllNot(){
    $(".dels").find("tr").each(function(){
        $(this).find(":checkbox").prop("checked",false).attr("checked",false);
    })
}
//反选
function checkOut(){
    $(".dels").find("tr").each(function(){
        if($(this).find(":checkbox").prop("checked")){
            $(this).find(":checkbox").prop("checked",false).attr("checked",false);
        }else{
            $(this).find(":checkbox").prop("checked",true).attr("checked",true);
        }
    })
}
//多条数据批量删除
$("#moredel").click(function(){
  layer.confirm('确认要删除吗',function(index){
    arr = [];
    var id;
    $(".dels").find("tr").each(function(){
        if($(this).find(":checked").prop("checked")){
            id =$(this).find(":checked").val();
            arr.push(id);
        }
    });
    $.get("/admin/users/moredel",{arr:arr},function(data){
        if(data==1){
            //把删除的数据所在的tr从dom删除
            for(var i=0;i<arr.length;i++){
                $(":input[value="+arr[i]+"]").parents("tr").remove();
            }
            layer.msg("删除数据成功",{icon:1,time:3000});
        }else{
            layer.msg("请选择至少一条数据",{icon:5,time:3000});
        }
    });
  });
});
</script>
@stop

