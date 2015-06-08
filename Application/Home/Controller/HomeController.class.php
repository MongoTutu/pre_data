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

    }

    public function add_news_post(){
        $d = I();
        dump($d);
    }

}
