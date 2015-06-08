<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {

    public function home(){
        $this->redirect('add_tz');
    }

    public function news(){
        $this->display();
    }

    public function add_news_post(){
        $d = I();
        dump($d);
    }

    public function uploads(){
        $d = $_FILES;
        $this->ajaxReturn($d);
    }

}
