<?php
namespace app\home\validate;
use think\Validate;
class login extends Validate{
	protected $rule = [
			'username'=>'require',
			'password'=>'require',
			'verify'  =>'require',
	];
   protected $message = [
		'username.require' =>"姓名必须填写",
		'password.require' =>"密码必须填写",
		'verify.require'   =>'校验码必须填写',


	];
}