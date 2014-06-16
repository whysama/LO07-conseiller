<?php

class ServiceScolarite extends Controller
{
    public function __construct(){
        session_start();
        parent::__construct();
        $this->servicescolarite_model = $this->loadModel("ServiceScolariteModel");
    }

    public function index(){
        echo ("<meta charset=\"UTF-8\">");
        //表格一

        if (isset($_POST['submit_select'])) {
            $_SESSION['views2'] = $_POST['views'];
            $_SESSION['programme_select'] = $_POST["programme_select"];
        }elseif($_SESSION['views2']== NULL){
            $_SESSION['views2'] = "all";
            $_SESSION['programme_select'] = "all";  
        }
        
        if ($_SESSION['views2'] == "all") {
            $flag = false;
            $etu = $this->servicescolarite_model->ETU_visualisation($_SESSION['programme_select']);
        }else{
            $flag = true;
            $etu = $this->servicescolarite_model->ETU_sans_conseiller($_SESSION['programme_select']);
        }

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

    public function ETU_suppression($id_ETU){
        if (isset($id_ETU)) {
            $this->servicescolarite_model->ETU_suppression($id_ETU);
        }
        header('location: '.URL.'ServiceScolarite/');
    }

    public function attribution_nouvel_etudiant($id_ETU){
        if (isset($id_ETU)) {
            $this->servicescolarite_model->attribution_nouvel_etudiant($id_ETU);
        }
        header('location: '.URL.'ServiceScolarite/');
    }

    public function attribution_nouvel_etudiant_form(){
        if (isset($_POST['submit_attr'])) {
            $this->servicescolarite_model->attribution_nouvel_etudiant($_POST['id_ETU_attr']);
        }
        header('location: '.URL.'ServiceScolarite/');
    }

    public function attribution_nouveaux_etudiants(){
        $this->servicescolarite_model->attribution_nouveaux_etudiants();
        header('location: '.URL.'ServiceScolarite/');
    }

    public function attribution_etudiant_transfert(){
        if (isset($_POST["submit_transfert"])) {
            $this->servicescolarite_model->attribution_etudiant_transfert($_POST['id_ETU'],$_POST['programme']);
        }
        header('location: '.URL.'ServiceScolarite/');
    }

    public function EC_visualisation_nombre_etudiants_decroissant(){
        $ec = $this->servicescolarite_model->EC_visualisation_nombre_etudiants_decroissant();
        require "application/views/ServiceScolarite/ec_nombre_etudiants.php";
    }

    public function ETU_avec_conseiller_list(){
        if (isset($_POST['programme_etu_avec_conseiller'])) {
            $etu = $this->servicescolarite_model->ETU_avec_conseiller_list($_POST["programme_etu_avec_conseiller"]);
        }else{
            $etu = $this->servicescolarite_model->ETU_avec_conseiller_list("All");
        }
        require "application/views/ServiceScolarite/etu_avec_conseiller.php";
    }
}