<?php
namespace app\admin\controller;
use app\admin\controller\Base;
class index extends Base{
	public function index(){
		return $this->fetch();
	}
}