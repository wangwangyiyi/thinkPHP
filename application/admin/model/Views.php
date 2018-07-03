<?php
namespace app\admin\model;
use think\Model;
class Views extends Model{
	protected $table = 'view';


	public function addFiles($files){
		$name = rand().$files['name'];
		$data['username'] = session('username');
		$data['name'] = $name;
		$data['time'] = time(); 

		$mvFiles = move_uploaded_file($files['tmp_name'], dirname(dirname(dirname(__dir__))).'/public/upLoadFiles/'.$name);
		if($mvFiles){
			$result = $this->save($data);
			
			if($result){
				return 1;
			}else{
				return 0;
			}
		}else{
			return "shibai";
		}
		
	}






} 