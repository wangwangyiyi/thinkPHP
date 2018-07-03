<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Views as viewsModel;
class Views extends Controller{
	public function views(){
		$views = new viewsModel;
		$result = $views->select();
		$this->assign('result',$result);
		return $this->fetch();
	}




	public function add(){
			if(request()->isPost()){
				if($files = $_FILES['files']){
					$views = new viewsModel;
					$result = $views->addFiles($files);
				if(!$result){
					return $this->error('失败！');
				}else{
					return $this->success('成功！','Views/views');
				}
			}
			
	}
		return $this->fetch();
	}


















} 