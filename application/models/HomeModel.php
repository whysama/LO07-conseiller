<?php

class HomeModel{

    function __construct($db){
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            echo("无法连接数据库");
        }
    }

    public function identifyUser($email,$pwd){
        $user = $this->getInfo($email,$pwd);
        if (!empty($user)) {
            session_start();
            $_SESSION['email']=$email;
            $_SESSION['pwd']=$pwd;
            $_SESSION['role']=$user[0]->role;
            $_SESSION['login']=true;
            switch ($_SESSION['role']) {
                case 'Etudiant':
                    return "Etudiant";
                    break;
                case 'DRH':
                    return "DirecteurRH";
                default:
                    return "Responsable";
                    break;
            }
        }
    }

    private function getInfo($email,$pwd){
        try {
            $sql = "SELECT * FROM USER WHERE email = ? AND pwd = ?";
            $query = $this->db->prepare($sql);
            $query->execute(array($email,$pwd));
            return $query->fetchAll();
        }catch (PDOException $e) {
            echo("Wrong:");
        }
    }
}