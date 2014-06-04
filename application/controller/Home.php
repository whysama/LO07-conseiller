<?php

class Home extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        require 'application/views/Home/index.php';
    }
    /**
     * 从view传来的数据，送进model处理，导向其他页面。
     */
    public function identifyUser(){
        if (isset($_POST["submit"])) {
            $home_model = $this->loadModel("HomeModel");
            $user = $home_model->identifyUser($_POST["email"],$_POST["pwd"]);
            header('location: '.URL.$user."/");
        }
    }

    public function logout(){
        session_destroy();
        header('location: '.URL."Home");
    }

}
