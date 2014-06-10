<?php

class DirecteurRH extends Controller
{
    private $directeur_model;

    public function __construct(){
        session_start();
        parent::__construct();
        $this->directeur_model = $this->loadModel("DirecteurRHModel");
    }

    public function index(){
        //利用session来控制表格数据的传送和显示
        if (isset($_POST['submit_role'])) {
            $_SESSION['submit_role']=$_POST['submit_role'];
        }
        if (isset($_SESSION['submit_role'])) {
            $ec = $this->EC_visualisation($_SESSION['submit_role']);
        }else{
            $ec = $this->EC_visualisation("Enseigants-Chercheurs");
        }

        require "application/views/DirecteurRH/index.php";
    }

    public function EC_vide(){
        $this->directeur_model->EC_vide();
        header('location: '.URL.'DirecteurRH/');
    }

    public function EC_suppression($id_EC){
        if (isset($id_EC)) {
            $this->directeur_model->EC_suppression($id_EC);
        }
        header('location: '.URL.'DirecteurRH/');
    }

    public function EC_ajout(){
        if(isset($_POST["submit_ec_ajout"])){
            $this->directeur_model->EC_ajout($_POST["nom"],$_POST["prenom"],$_POST["bureau"],$_POST["pole"]);
        }
        header('location: '.URL.'DirecteurRH/');
    }

    public function EC_ajout_liste(){
        if (isset($_FILES['csv'])) {
            $this->directeur_model->EC_ajout_liste($_FILES["csv"]["tmp_name"]);
        }
        header('location: '.URL.'DirecteurRH/');
    }

    public function EC_visualisation($role){
        $ec = $this->directeur_model->EC_visualisation($role);
        return $ec;
    }

    public function EC_visualisation_nombre_etudiants_decroissant(){
        $ec = $this->directeur_model->EC_visualisation_nombre_etudiants_decroissant();
        require "application/views/DirecteurRH/ec_nombre_etudiants.php";
    }

    public function EC_visualisation_avec_etudiant(){
        $ec = $this->directeur_model->EC_visualisation_avec_etudiant();
        require "application/views/DirecteurRH/ec_avec_etudiant.php";
    }

}