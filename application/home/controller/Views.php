<?php
namespace app\home\controller;
use app\admin\model\Cate as cateModel;
use app\admin\model\Views as viewsModel;

use think\Controller;
class Views extends Controller{
	public function views(){

		$cateModel = new cateModel;
		$result = $cateModel->select();
		$this->assign('result',$result);

		$viewsModel = new viewsModel;
		$resul = $viewsModel->select();
		$this->assign('resul',$resul);

		return $this->fetch();
	}










} 