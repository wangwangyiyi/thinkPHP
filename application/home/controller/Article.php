<?php
namespace app\home\controller;
header('Content=Text/html,charset=utf-8');

use think\Controller;
use app\admin\model\Article as articleModel;
use app\home\model\Message as messageModel;
use app\home\controller\Base; 
use think\Db;

class Article extends Controller{
	public function article()
	{
			if(request()->isGet()){
				$data['id']  = input('id');

				$model = new articleModel;
				$result = $model->where('id',$data['id'])->select();
				$this->assign('result',$result);

				// $model = new articleModel;
				$result = $model->field('p_id')->where('id',$data['id'])->select();
				$data['p_id'] = $result[0]['p_id'];

				$mode = new messageModel;
				$dat = $mode->where('p_id',$data['p_id'])->select();
				$this->assign('dat',$dat);

				return $this->fetch();


			}				

			if(request()->isPost()){

			$id = input('id');
			$model = new articleModel;
			$result = $model->field('p_id')->where('id',$id)->select();
			$data['username'] = session('username');
			$data['message'] = input('message');
			$data['time'] = time();
			$data['p_id'] = $result[0]['p_id'];
			$model = Db::name('message')->insert($data);
			if($model){
				return $this->success('成功！');					
			}else{
				return $this->error("失败！");
			}


			}
			$data['id']  = input('id');

			
	}

	public function message(){

		if(request()->isGet()){
			if(empty(session('username'))){
				return $this->error("您没有登录，请登录后再评论！",'Login/login');
			}
			$id = $_GET['id'];
			$p_id = $_GET['p_id'];

			$model = new articleModel;
			$result = $model->field('p_id')->where('id',$id)->select();
			$data['username'] = session('username');

			$data['message'] = input('message');
			$data['time'] = time();
			$data['p_id'] = $result[0]['p_id'];
			$model = Db::name('message')->insert($data);
			if($model){
					
					return $this->success('成功');
			}else{
				return $this->error("失败！");
			}
		}
	}

	




}






