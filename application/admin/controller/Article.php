<?php
namespace app\admin\controller;
use app\admin\model\Cate as cateModel;
use app\admin\model\Article as articleModel;

use app\admin\validate\Article as articleValidate;
use think\Controller;
class Article extends Controller{
	public function article(){
		$model = new articleModel;
		$result = $model->paginate(10);
		$this->assign('result',$result);
		return $this->fetch();
	}
	public function add(){
		if(request()->isPost()){
			$data['author'] = input('author');
			$data['title'] = input('title');
			$data['p_id'] = input('p_id');
			$data['content'] = input('content');
			$data['time'] = time();
			$file = $_FILES['pic']['tmp_name'];

			$width = getimagesize($file)[0];
			$height = getimagesize($file)[1];
			if($width>600|$height>400){
				return $this->error('图片宽度和高度超出限制！请重新选择！');
			};
			$paths = __dir__;
			$path = str_replace('\\','/',substr($paths,0,strrpos($paths,'\\')-17));
			$filename = rand();
			$info = move_uploaded_file($file, $path.'public/upLoadFiles/'.$filename.$_FILES['pic']['name']);
			$data['pic'] = $filename.$_FILES['pic']['name'];
			$validate = new articleValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}
			$model = new articleModel;
			$add = $model->save($data);
			if($add){
				return $this->success('成功！','Article/article');
			}else{
				return $this->error('失败！');
			}
		}

		$model = new cateModel;
		$result = $model->field('catename')->select();
		$this->assign('result',$result);
		return $this->fetch();
	}
	
	public function edit(){
		$cur['id'] = $_GET['id'];

		if(request()->ispost()){
			$data['author'] = input('author');
			$data['title'] = input('title');
			$data['p_id'] = input('p_id');
			$data['content'] = input('content');
			$data['time'] = time();
			$file = $_FILES['pic']['tmp_name'];
			$paths = __dir__;
			$path = str_replace('\\','/',substr($paths,0,strrpos($paths,'\\')-17));
			$filename = rand();
			$info = move_uploaded_file($file, $path.'public/upLoadFiles/'.$filename.$_FILES['pic']['name']);
			$data['pic'] = $filename.$_FILES['pic']['name'];
			$validate = new articleValidate;
			if(!$validate->check($data)){
				return $this->error($validate->getError());
			}
			$model = new articleModel;
			$update = $model->where('id',$cur['id'])->update($data);
			if($update){
				return $this->success('成功！');
			}else{
				return $this->error('失败！');
			}
		}
			$model = new cateModel;
			$cates = $model->select();
			$this->assign('cates',$cates);
		

			$model = new articleModel;
			$result = $model->where('id',$cur['id'])->find();
			$this->assign('result',$result);
			return $this->fetch();		
	}




	public function del(){
		$data['id'] = $_GET['id'];
		$model = new articleModel;
		$result = $model->where('id',$data['id'])->delete();
		if(!$result){
			return $this->error('失败！');
		}else{
			return $this->success('成功！');

		}
	}		
} 



















