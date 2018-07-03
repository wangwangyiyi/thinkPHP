<?php
namespace app\admin\controller;
use app\admin\validate\Cate as cateValidate;
use app\admin\model\Cate as cateModel;
use app\admin\controller\Base;
class Cate extends Base{
	public function cate(){
		$model = new cateModel;
		$result = $model->select();
		$this->assign('result',$result);
		return $this->fetch();
	}
	

	public function add(){
		if(request()->isPost()){
			$data['catename'] = input('catename');
			$validate = new cateValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError(),'Cate/cate');
			}
			$model = new cateModel;
			$add = $model->where('catename',$data['catename'])->find();
			if($add){
				return $this->error('栏目名称已经存在！','Cate/cate');
			}else{
				$model->save(['catename'=>$data['catename']]);
				return $this->success('添加栏目成功!','Cate/cate');
			}
		}
		return $this->fetch();
	}
	public function edit(){
		$model = new cateModel;
		if(request()->isPost()){
			$data['id'] = $_GET['id'];
			$data['catename'] = input('catename');
			// var_dump($data);exit;
			$validate = new cateValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError()); 
			}
			$edit = $model->where('catename',$data['catename'])->find();
			if($edit){
				return $this->error('栏目名称已经存在！','Cate/cate');
			}else{
				$model->update(['id'=>$data['id'],'catename'=>$data['catename']]);
				return $this->success('修改成功！','Cate/cate');
			}
		}
		$data['id'] = $_GET['id'];
		$result = $model->where('id',$data['id'])->find();
		$this->assign('result',$result);		
		return $this->fetch();
	}
	public function del(){
		$data['id'] = $_GET['id'];
		$result = cateModel::destroy($data['id']);
		if($result){
			return $this->success('成功！','Cate/cate');
		}
	}



}















