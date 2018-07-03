<?php
namespace app\home\validate;
use think\Validate;
class register extends Validate{
	 protected $rule = [
			'username'=>'require',
			'password'=>'require',
			're-password'=>'require',

			'verify'  =>'require',
	];
	protected $message = [
		'username.require' =>"姓名必须填写",
		'password.require' =>"密码还是要必须填写",
		're-password.require' =>"验证密码还是要必须填写",

		'verify.require' =>"验证码还是要必须填写",

	];
}