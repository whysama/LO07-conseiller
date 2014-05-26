<?php

class ServiceScolarite extends Controller
{
    public function __construct(){
        session_start();
        parent::__construct();
        $this->servicescolarite_model = $this->loadModel("ServiceScolariteModel");
    }

    public function index(){
        var_dump($_POST);
        $etu = (isset($_POST['programme_select'])) ? $this->servicescolarite_model->ETU_sans_conseiller($_POST['programme_select']) : $this->servicescolarite_model->ETU_sans_conseiller("all") ;
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

    public function ETU_ajout_liste(){
        if (isset($_POST['submit_etu_ajout_liste'])) {
            $this->servicescolarite_model->ETU_ajout_liste($_FILES["csv"]["tmp_name"]);
        }
        header('location: '.URL.'ServiceScolarite/');
    }

    public function ETU_sans_conseiller(){
        if (isset($_POST['programme'])) {
            $etu = $this->servicescolarite_model->ETU_sans_conseiller($_POST['programme']);
            return $etu;
        }
    }
}