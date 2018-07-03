<?php
namespace app\home\controller;
use app\admin\model\Cate as cateModel;
use app\admin\model\Article as articleModel;
use app\home\model\Views as viewsModel;

use think\Controller;
class Index extends Controller{
	public function index()
	{	
		$cateModel = new cateModel;
		$result = $cateModel->select();
		$this->assign('result',$result);

		$articleModel = new articleModel;
		$resul = $articleModel->paginate(10);
		$this->assign('resul',$resul);
		return $this->fetch();
	}
	public function cate(){
		if(request()->isGet()){
			
			$cateModel = new cateModel;
			$result = $cateModel->select();
			$this->assign('result',$result);

			
			$viewsModel = new viewsModel;
			$resu = $viewsModel->paginate(1);
			$this->assign('resu',$resu);


			$data['p_id'] = input('p_id');
			$articleModel = new articleModel;
			$resul = $articleModel->where('p_id',$data['p_id'])->select();
			$this->assign('resul',$resul);
			

			return $this->fetch();

		}
	}





}