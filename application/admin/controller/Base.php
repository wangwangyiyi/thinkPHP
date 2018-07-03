<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
	public function _initialize(){
		if(!session('username')){
			return $this->error('没有登录！','Login/login');
		}
	}
}