<?php
namespace app\admin\validate;
use think\Validate;
class Article extends Validate{
	protected $rule = [
		'author'     => 'require',
		'title'     => 'require',
		'content'     => 'require',
		'pic'     => 'require',
	];
	protected $message = [
		'author.require'     => '作者名称必须填写',
		'title.require'     => '标题必须填写',
		'content.require'     => '内容必须填写',
		'pic.require'     => '内容的图片必须填写',
	];
}