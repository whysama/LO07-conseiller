<?php

class Etudiant extends Controller
{
    public function index(){
        echo "Etudiant-index()";
        $etudiant_model = $this ->loadModel("EtudiantModel");
        $etudiant = $etudiant_model->getInfo("shenyang.zhou@utt.fr");
        $conseiller = $etudiant_model->getConseiller($etudiant[0]->id_ETU);
        require "application/views/etudiant/index.php";
    }
}