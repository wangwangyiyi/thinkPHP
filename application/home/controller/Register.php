<?php
namespace app\home\controller;
use think\Controller;
use app\home\model\Register as registerModel;
use app\home\validate\Register as validateregister;
class Register extends Controller{
	public function register()
	{	
		if(request()->isPost()){
			// var_dump(input('post.'));
			$data['username'] =input("username");
			$data['password'] =input("password");
			$data['re-password'] =input("re-password"); 
			$data['verify'] =input("verify"); 

			$validate = new validateregister;
			if(!$validate->check($data))
			{
				return $this->error($validate->getError());
			}else
			{
				if($data['password'] !== $data['re-password'])
				{		
					return $this->error("密码不一致！");

				}
				$captcha =  new \think\captcha\Captcha();
				if(!$captcha->check($data['verify'])){
					return $this->error("验证码有误！");
				}
				$model = new registerModel;
				if($model->where('username',$data['username'])->select()){
					return $this->error("用户已经存在！");
				}
				$result = $model->save([
					'username'=>$data['username'],
					'password'=>$data['password'],

				]);
					if($result){
						return $this->success("成功！");
					}


			}	
			exit;
		}



		return $this->fetch();



	}
}