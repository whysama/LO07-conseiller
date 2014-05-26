<?php

class DirecteurRH extends Controller
{
    public function index(){
        $ec = $this->EC_visualisation();
        require "application/views/DirecteurRH/index.php";
    }

    public function EC_vide(){
        $directeur_model = $this->loadModel("DirecteurRHModel");
        $directeur_model->EC_vide();
        header('location: '.URL.'DirecteurRH/');
    }

    public function EC_ajout(){
        echo "Ajout EC";
        if(isset($_POST["submit_ec_ajout"])){
            $directeur_model = $this->loadModel("DirecteurRHModel");
            $directeur_model->EC_ajout($_POST["nom"],$_POST["prenom"],$_POST["bureau"],$_POST["pole"]);
        }
        header('location: '.URL.'DirecteurRH/');
    }

    public function EC_ajout_liste(){
        if (isset($_FILES['csv'])) {
            $directeur_model = $this->loadModel("DirecteurRHModel");
            $directeur_model->EC_ajout_liste($_FILES["csv"]["tmp_name"]);
        }
        header('location: '.URL.'DirecteurRH/');
    }

    public function EC_visualisation(){
        $directeur_model = $this->loadModel("DirecteurRHModel");
        $ec = $directeur_model->EC_visualisation();
        return $ec;
    }

}