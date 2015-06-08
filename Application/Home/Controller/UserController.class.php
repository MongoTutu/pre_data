<?php
namespace Home\Controller;
use Think\Controller\RestController;
class UserController extends RestController {

    public function user_lists(){
        $res = $this->_type;
        $res .= " / ";
        $res .= $this->_method;
        $res .= " / ";
        $res .= "user_lists";
        $this->ajaxReturn($res);
    }

    public function add_user(){

    }

    public function register(){
        $email = I('email');
        $username = I('username');
        $password = I('password');

        if(!check_email($email)){
            $res['meta'] = http_status(400);
			$res['data'] = array('status'=>0,'tips'=>'(E-mail format error)邮箱格式错误');
            $this->ajaxReturn($res);
        }

        if(!check_password($password)){
            $res['meta'] = http_status(400);
			$res['data'] = array('status'=>0,'tips'=>'(Passwords must be 6-16, and can not be a pure digital and pure and letters)密码必须是6到16位,且不能是纯数字与纯字母的密码');
            $this->ajaxReturn($res);
        }

        if(!check_username($username)){
            $res['meta'] = http_status(400);
			$res['data'] = array('status'=>0,'tips'=>'(Username format is incorrect)用户名格式不正确');
            $this->ajaxReturn($res);
        }

        $user['email'] = $email;
        $user['username'] = $username;
        $user['password'] = md5_password($password);
        $user['reg_time'] = time();
        $user['reg_ip'] = ip2long($_SERVER['REMOTE_ADDR']);

        $user_model = D('Common/User');
        if($user_model->is_email_exsist($email)){
            $res['meta'] = http_status(400);
			$res['data'] = array('status'=>0,'tips'=>'(E-mail has been registered)邮箱已被注册了');
            $this->ajaxReturn($res);
        }
        $res = $user_model->user_register($user);

        $this->ajaxReturn($res);
    }

    public function login(){
        $email = I('email');
        $password = I('password');

        if(!check_email($email)){
            $res['meta'] = http_status(400);
			$res['data'] = array('status'=>0,'tips'=>'(E-mail format error)邮箱格式错误');
            $this->ajaxReturn($res);
        }

        if(!check_password($password)){
            $res['meta'] = http_status(400);
			$res['data'] = array('status'=>0,'tips'=>'(Passwords must be 6-16, and can not be a pure digital and pure and letters)密码必须是6到16位,且不能是纯数字与纯字母的密码');
            $this->ajaxReturn($res);
        }

        $user['email'] = $email;
        $user['password'] = md5_password($password);

        $user_model = D('Common/User');
        $res = $user_model->user_login($user);

        $this->ajaxReturn($res);
    }

    public function get_user(){
        $res = $this->_type;
        $res .= " / ";
        $res .= $this->_method;
        $res .= " / ";
        $res .= "get_user";
        $this->ajaxReturn($res);
    }

    public function update_user(){
        $res = $this->_type;
        $res .= " / ";
        $res .= $this->_method;
        $res .= " / ";
        $res .= "update_user";
        $res .= " / ".I('id');
        $this->ajaxReturn($res);
    }

    public function delete_user(){
        $res = $this->_type;
        $res .= " / ";
        $res .= $this->_method;
        $res .= " / ";
        $res .= "delete_user";
        $res .= " / ".I('tk');
        $this->ajaxReturn($res);
    }

}
