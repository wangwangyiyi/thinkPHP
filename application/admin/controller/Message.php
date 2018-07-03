<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Message as messageModel;
class Message extends Controller{
	public function message(){
		$model = new messageModel;
		$result = $model->paginate(10);
		$this->assign('result',$result);

		return $this->fetch();
	} 











} 