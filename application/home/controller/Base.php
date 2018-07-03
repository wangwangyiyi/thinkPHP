<?php
namespace app\home\controller;
use think\Controller;
class Base extends Controller{
		public function _initialize(){
		if(!session('username')){
			return $this->error('请先登录再行操作！','Login/login');
		}
	}
} 