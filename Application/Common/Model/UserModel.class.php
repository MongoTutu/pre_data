<?php
namespace Common\Model;
use Think\Model;
class UserModel extends Model{

	public function get_user_token($id){
		$d = $this->where(array('id'=>$id))->find();
		$token = $id.':'.$d['username'];
		$tk = get_token($token);
		$rep = $d['email'].':'.$tk;
		return array('id'=>$d['id'],'token'=>$rep);
	}

    public function user_register($user=array()){
        $res = $this->data($user)->add();
        return $this->get_user_token($res);
    }

    public function user_login($user=array()){
        $res = $this->where($user)->find();
		if($res){
	        return $this->get_user_token($res['id']);
		}else{
			$res['meta'] = http_status(401);
			$res['data'] = array('status'=>0,'tips'=>'(Login information is incorrect, you can not log in)登录信息错误，无法登录');
			return $res;
		}
    }

    public function is_email_exsist($email){
        $res = $this->where(array('email'=>$email))->find();
        return $res;
    }


}
