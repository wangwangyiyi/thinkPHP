<?php
namespace app\admin\validate;
use think\Validate;
class Home extends Validate{ 
	
	protected $rule = [
		'username'  =>'require',
		'password'  =>'require',
		're_password'  =>'require',

	];
	protected $message = [

		'username.require'  =>'用户名不能为空',
		'password.require'  =>'密码不能为空',
		're_password.require'  =>'确认密码不能为空',
	];
}