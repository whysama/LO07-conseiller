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
       // $responsable_model = $this->loadModel("ResponsableModel");
        $c = $this->responsable_model->CONSEILLER_visualisation();
        $h = $this->responsable_model->Habilitation_visualisation_etu_ec();
        require "application/views/Responsable/index.php";
    }

    public function Habilitation_ajout(){
        if (isset($_POST["submit_Habilitation_ajout"])) {
        //    $responsable_model = $this->loadModel("ResponsableModel");
            $this->responsable_model->Habilitation_ajout($_POST["id_EC"]);
        }
      header('location: '.URL.'Responsable/');
    }

    public function Habilitation_par_pole(){
        if (isset($_POST["submit_Habilitation_par_pole"])) {
         //   $responsable_model = $this->loadModel("ResponsableModel");
         var_dump($this->responsable_model);
            $this->responsable_model->Habilitation_par_pole($_POST["pole"]);
        }
        header('location: '.URL.'Responsable/');
    }

    public function Habilitation_suppression($id_EC){
        if (isset($id_EC)) {
         //   $responsable_model = $this->loadModel("ResponsableModel");
            $this->responsable_model->Habilitation_suppression($id_EC);
        }
        header('location: '.URL.'Responsable/');
    }

    public function CONSEILLER_visualisation(){
   //     $responsable_model = $this->loadModel("ResponsableModel");
        $c = $this->responsable_model->CONSEILLER_visualisation();
        return $c;
    }

    public function Habilitation_visualisation_etu_ec(){
  //      $responsable_model = $this->loadModel("ResponsableModel");
        $c = $this->responsable_model->CONSEILLER_visualisation();
        return $c;
    }

}