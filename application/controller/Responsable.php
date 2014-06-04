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
        $c = $this->CONSEILLER_visualisation();
        $h = $this->Habilitation_visualisation_etu_ec();
        $ec = $this->EC_visualisation();
        require "application/views/Responsable/index.php";
    }

    public function Habilitation_ajout($id_EC){
        if (isset($id_EC)) {
            $this->responsable_model->Habilitation_ajout($id_EC);
        }
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
        header('location: '.URL.'Responsable/');
    }

    public function CONSEILLER_visualisation(){
        $c = $this->responsable_model->CONSEILLER_visualisation();
        return $c;
    }

    public function Habilitation_visualisation_etu_ec(){
        $c = $this->responsable_model->Habilitation_visualisation_etu_ec();
        return $c;
    }

    public function EC_visualisation(){
        if (isset($_POST['EC_pole'])) {
            return $this->responsable_model->EC_visualisation($_POST['EC_pole']);
        }else{
            return $this->responsable_model->EC_visualisation("ALL");
        }
    }

}