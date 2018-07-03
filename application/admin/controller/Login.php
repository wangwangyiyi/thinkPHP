<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Login as loginModel;
use app\admin\validate\Login as loginValidate;
class Login extends Controller{
	public function login(){
		if(request()->isPost()){
			$data['username'] = input("username");
			$data['password'] = input("password");
			$validate = new loginValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}
			$model = new loginModel;
			// var_dump($model);
			// exit;
			$result = $model->where("username",$data['username'])->find();
			if(!$result){
				return $this->error("用户名错误！");
			}
			if($result->password !== $data['password']){
				return $this->error("密码输入错误！");
			}else{
				session('username',$data['username']);
				session('password',$data['password']);
				return $this->success("登录成功！",'Index/index');
			}
		}
		return $this->fetch();	
	}
}
