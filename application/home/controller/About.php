<?php
namespace app\home\controller;
use app\admin\model\Cate as cateModel;

use think\Controller;
class About extends Controller{
	public function about(){
		$cateModel = new cateModel;
		$result = $cateModel->select();
		$this->assign('result',$result);

		return $this->fetch();
	}
}