<?php

class ServiceScolarite extends Controller
{
    public function __construct(){
        session_start();
        parent::__construct();
        $this->servicescolarite_model = $this->loadModel("ServiceScolariteModel");
    }

    public function index(){
        //改变表格显示，选择要哪种表格
        echo ("<meta charset=\"UTF-8\">");
        //表格一
        if (isset($_POST['submit_select'])) {
            if ($_POST['views'] == "all") {
                $flag = false;
                $etu = $this->servicescolarite_model->ETU_visualisation($_POST["programme_select"]);
            }else{
                $flag = true;
                $etu = $this->servicescolarite_model->ETU_sans_conseiller($_POST["programme_select"]);
                if ($_POST['programme_select']=="TC") {
                    $tc = true;
                }else{
                    $tc = false;
                }
            }
        }else{
            $flag = false;
            $etu = $this->servicescolarite_model->ETU_visualisation("all");
        }
        //表格二
        if (isset($_POST['submit_select2'])) {
                $etu2 = $this->servicescolarite_model->ETU_avec_conseillet_list($_POST["programme_select2"]);
        }else{
                $etu2 = $this->servicescolarite_model->ETU_avec_conseillet_list("all");
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
}