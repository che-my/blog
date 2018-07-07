<?php $__env->startSection('content-header'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">用户管理 -  用户列表</li>
    </ol>
    <h1>
        用户管理
        <small><a href="/admin/users/add" class="btn btn-success">添加用户</a></small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">用户列表</h3>
            <div class="box-tools">
                <form action="/admin/users" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="keywords"
                               style="width: 150px;" placeholder="搜索会员" value="<?php echo e($keywords); ?>">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <!--tr-th start-->
                    <tr>
                        <th>全选</th>
                        <th>昵称</th>
                        <th>邮箱</th>
                        <th>是否验证</th>
                        <th>发布时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <!--tr-th end-->
                <tbody class="dels">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class=""><input type="checkbox" value="<?php echo e($user['id']); ?>"></td>
                        <td class="text-muted"><?php echo e($user['name']); ?></td>
                        <td class="text-muted"><?php echo e($user['email']); ?></td>
                        <td class="text-muted"><?php echo e($user['remember_token']); ?></td>
                        <td class="text-navy"><?php echo e($user['created_at']); ?></td>
                        <td class="text-navy"><?php echo e($user['updated_at']); ?></td>
                        <td>
                            <a style="font-size: 16px" href="/admin/users/edit/id/<?php echo e($user['id']); ?>"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            <a style="font-size: 16px;color: #dd4b39;" href="JavaScript:void(0);" onclick="del(<?php echo e($user['id']); ?>)" delname="<?php echo e($user['id']); ?>"><i class="fa fa-fw fa-trash-o" title="删除"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                    <tr>
                        <td colspan="7">
                            <button class="btn btn-sm btn-info" onclick="checkAll()">全选</button>
                            <button class="btn btn-sm btn-danger" onclick="checkAllNot()">全不选</button>
                            <button class="btn btn-sm btn-warning" onclick="checkOut()">反选</button>
                            <button id="moredel" class="btn btn-sm btn-primary">批量删除</button>
                        </td>
                    </tr>

            </table>
            <div id="pages" class="text-right">
                <?php echo $users->appends($request)->render(); ?>

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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>