<?php
namespace app\home\controller;
use think\Controller;
use app\home\validate\Login as loginValidate;
use app\home\model\Register as loginModel;
class login extends Controller{
	public function login(){
		if(request()->isPost()){
			$data['username'] = input('username');
			$data['password'] = input('password');
			$data['verify'] = input('verify');
			$validate = new loginValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}


			$captcha =  new \think\captcha\Captcha();
			if(!$captcha->check($data['verify'])){
				return $this->error("验证码有误！");
			}


			$model = new loginModel;
			$result = $model->where('username',$data['username'])->find();
			if(!$result){
				return $this->error("用户名不存在！");
			}
			if($result->password !== $data['password']){
				return $this->error("密码不正确");
			}else{

				session("username",$data['username']);
				session("password",$data['password']);
				return $this->success("成功么么哒！",'Index/cate');
			}
	}
		// var_dump(session(''));
		return $this->fetch();
	}

} 


