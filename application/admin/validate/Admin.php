<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate{
	protected $rule = [
		'username'      =>'require',
		're_password'      =>'require',
		'password'      =>'require',
	];
	protected $message = [
		'username.require'   =>'..名字不能为空',
		'password.require'   =>'密码不能为空',
		're_password.require'   =>'确认密码不能为空',
	];
}