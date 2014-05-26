<?php

class Etudiant extends Controller
{
    public function index(){
        echo "Etudiant-index()";
        $etudiant_model = $this ->loadModel("EtudiantModel");
        $etudiant = $etudiant_model->getInfo("shenyang.zhou@utt.fr");
        require "application/views/etudiant/index.php";
    }
}