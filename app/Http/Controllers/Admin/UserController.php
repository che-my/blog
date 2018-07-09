<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入db类
use DB;

class UserController extends Controller
{
    //加载用户列表页
    public function index(Request $request)
    {
    	$keywords = $request->input('keywords');
    	$users = DB::table("users")->select('id','name','email','remember_token','created_at','updated_at')->where('name', 'like',"%{$keywords}%")->paginate(2);
        return view('admin.users.index',["users"=>$users,'request'=>$request->all(),"keywords"=>$keywords]);
    }

    //加载用户列表页
    public function add()
    {
        return view('admin.users.add');
    }

    //添加数据
    public function insert()
    {
        return view('admin.users.add');
    }

    //单条数据删除
    public function delete(Request $request)
    {
    	if($request->ajax()){
			$id = $request->input('id');
			if(DB::table("users")->where("id",$id)->delete()){
				return 1;
			}
    	}
    }

    //批量数据删除
    public function moredel(Request $request)
    {
    	if($request->ajax()){
			$arr = isset($_GET['arr'])?$_GET['arr']:'';
			if($arr==''){
	            return 0;
	        }
	        foreach($arr as $v){
	            DB::table("users")->where("id",$v)->delete();
	        }
	        return 1;
    	}
    }

}
