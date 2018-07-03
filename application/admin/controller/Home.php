<?php
namespace app\admin\controller;
use app\admin\model\Home as homeModel;
use app\admin\validate\Home as homeValidate;
use app\admin\controller\Base;
class Home extends Base{
	public function home(){
		$model = new homeModel;
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
			$validate = new homeValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}
			if($data['password'] !==$data['re_password']){
				return $this->error('密码不一致！');
			}
			$model = new homeModel;
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
			$validate = new homeValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}
			if($data['password'] !==$data['re_password']){
				return $this->error('密码不一致！','Admin/admin');
			}
			$model = new homeModel;
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
		$model = new homeModel;
		$result = $model->where('id',$data['id'])->find();
		$this->assign('result',$result);
		return $this->fetch();
	}
	public function del(){
		$data['id'] = $_GET['id'];
		// $model = new loginModel;
		$result = homeModel::destroy($data['id']);
		if($result){
			return $this->success('成功！');
		}
	}








}