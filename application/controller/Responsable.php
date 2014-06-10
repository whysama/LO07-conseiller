<?php

class Responsable extends Controller
{
    private $responsable_model;
    public $info;

    public function __construct(){
        session_start();
        parent::__construct();
        $this->responsable_model = $this->loadModel("ResponsableModel");
        $this->responsable_model->setProgramme($_SESSION["role"]);
        $this->info = $this->responsable_model->getInfo($_SESSION["email"]);
    }

    public function index(){
        if (isset($_POST['submit_pole'])) {
            $_SESSION['submit_pole']=$_POST['submit_pole'];
        }
        if (isset($_SESSION['submit_pole'])) {
            $ec = $this->EC_visualisation($_SESSION['submit_pole']);
        }else{
            $ec = $this->EC_visualisation("ALL");
        }

        require "application/views/Responsable/index.php";
    }

    public function Habilitation_ajout(){
        if (isset($_POST['submit_Habilitation_ajout'])) {
            $this->responsable_model->Habilitation_ajout($_POST['id_EC']);
        }
        header('location: '.URL.'Responsable/');
    }

    public function Habilitation_ajout_form($id_EC){
        $this->responsable_model->Habilitation_ajout($id_EC);
        header('location: '.URL.'Responsable/');
    }

    public function Habilitation_par_pole(){
        if (isset($_POST["submit_Habilitation_par_pole"])) {
            $this->responsable_model->Habilitation_par_pole($_POST["pole"]);
        }
        header('location: '.URL.'Responsable/');
    }

    public function Habilitation_suppression($id_EC){
        if (isset($id_EC)) {
            $this->responsable_model->Habilitation_suppression($id_EC);
        }
        header('location: '.URL.'Responsable/CONSEILLER_visualisation');
    }

    public function CONSEILLER_visualisation(){
        $conseiller = $this->responsable_model->CONSEILLER_visualisation();
        require "application/views/Responsable/conseiller.php";
    }

    public function Habilitation_visualisation_etu_ec(){
        $ec = $this->responsable_model->Habilitation_visualisation_etu_ec();
        require "application/views/Responsable/etu_ec.php";
    }

    public function EC_visualisation($pole){
        return $this->responsable_model->EC_visualisation($pole);
    }

}