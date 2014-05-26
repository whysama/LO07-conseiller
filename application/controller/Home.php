<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // debug message to show where you are, just for the demo
        //echo 'Message from Controller: You are in the controller home, using the method index()';
        require 'application/views/Home/index.php';
    }

    public function identifyUser(){
        if (isset($_POST["submit"])) {
            $home_model = $this->loadModel("HomeModel");
            $user = $home_model->identifyUser($_POST["email"],$_POST["pwd"]);
            header('location: '.URL.$user."/");
        }
    }

}
