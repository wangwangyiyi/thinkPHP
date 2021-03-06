<?php
namespace app\admin\controller;
use app\admin\model\Login as loginModel;
use app\admin\validate\Admin as adminValidate;
use app\admin\controller\Base;
class Admin extends Base{
	public function admin(){
		$model = new loginModel;
		$result = $model->select();
		$this->assign('result',$result);

		return $this->fetch();
	}
	public function add(){
		if(request()->isPost()){
			$data['username'] = input('username');
			$data['password'] = input('password');
			$data['re_password'] = input('re_password');
			 // var_dump($data);
			$validate = new adminValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}
			if($data['password'] !==$data['re_password']){
				return $this->error('密码不一致！');
			}
			$model = new loginModel;
			$result = $model->where('username',$data['username'])->find();
			if($result){
				return $this->error("名字已经存在！");
			}
			$insert = $model->save(['username'=>$data['username'],'password'=>$data['password']]);
			if(!$insert){
				return $this->error('失败！');
			}else{
				return $this->success("成功！",'Admin/admin');
			}
		}

		return $this->fetch();
	}
	public function edit(){
		$data['id'] = $_GET['id'];
		// var_dump($data);
		
		if(request()->isPost()){
			$data['id'] = input('id');

			$data['username'] = input('username');
			$data['password'] = input('password');
			$data['re_password'] = input('re_password');
			$validate = new adminValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}
			if($data['password'] !==$data['re_password']){
				return $this->error('密码不一致！','Admin/admin');
			}
			$model = new loginModel;
			$result = $model->where('username',$data['username'])->find();
			if($result){
				return $this->error('用户名已存在','Admin/admin');
			}else{
				$update = $model->where('id',$data['id'])->update(['username'=>$data['username'],'password'=>$data['password']]);
				if($update){
					return $this->success('成功！','Admin/admin');
				}
			}
		}
		$model = new loginModel;
		$result = $model->where('id',$data['id'])->find();
		$this->assign('result',$result);
		return $this->fetch();
	}
	public function del(){
		$data['id'] = $_GET['id'];
		// $model = new loginModel;
		$result = loginModel::destroy($data['id']);
		if($result){
			return $this->success('成功！');
		}
	}








}