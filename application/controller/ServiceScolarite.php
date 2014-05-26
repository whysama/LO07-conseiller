<?php

class ServiceScolarite extends Controller
{
    public function __construct(){
        session_start();
        parent::__construct();
        $this->servicescolarite_model = $this->loadModel("ServiceScolariteModel");
    }

    public function index(){
        require "application/views/ServiceScolarite/index.php";
    }

    public function ETU_vide(){
        $this->servicescolarite_model->ETU_vide();
        header('location: '.URL.'ServiceScolarite/');
    }

    public function ETU_ajout(){
        if (isset($_POST["submit_ETU_ajout"])) {
            $this->servicescolarite_model->ETU_ajout($_POST['nom'],$_POST['prenom'],$_POST['programme'],$_POST['semestre']);
        }
        header('location: '.URL.'ServiceScolarite/');
    }


}