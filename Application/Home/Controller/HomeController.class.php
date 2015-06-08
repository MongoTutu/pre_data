<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {

	public function home(){
		$this->redirect('add_tz');
	}

	public function add_tz(){
		$this->display();
	}

	public function add_rz(){
		$this->display();
	}

	public function add_tz_post(){
		$d = I();
		$d['time'] = time();
		$res = D('Common/Tz')->data($d)->add();
		if($res){
			$this->success("Success");
		}else{
			$this->error("Error");
		}
	}

	public function add_rz_post(){
		$d = I();
		$d['time'] = time();
		$res = D('Common/Rz')->data($d)->add();
		if($res){
			$this->success("Success");
		}else{
			$this->error("Error");
		}
	}

	public function show_tz(){
		$d = D('Common/Tz')->select();
		$this->data = $d;
		$this->display();
	}

	public function show_rz(){
		$d = D('Common/Rz')->select();
		$this->data = $d;
		$this->display();
	}

	public function delete_tz(){
		$id = I('id');
		$res = D('Common/Tz')->where(array('_id'=>$id))->delete();
		if($res){
			$this->success('Delete Item Success');
		}else{
			$this->error('Error! Already Deleted');
		}
	}
	public function delete_rz(){
		$id = I('id');
		$res = D('Common/Rz')->where(array('_id'=>$id))->delete();
		if($res){
			$this->success('Delete Item Success');
		}else{
			$this->error('Error! Already Deleted');
		}
	}

}
