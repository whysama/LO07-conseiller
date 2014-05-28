<?php

class EtudiantModel {

    function __construct($db){
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('无法连接');
        }
    }
    /**
     * 返回学生信息 用于index
     * @param  String $email [description]
     * @return Array       [description]
     */
    public function getInfo($email){
        $sql = "SELECT * FROM ETU WHERE email='".$email."'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getConseiller($id_ETU){
        $sql = "SELECT * FROM EC WHERE id_EC IN(SELECT id_EC FROM LIEN WHERE id_ETU = ? )";
        $query = $this->db->prepare($sql);
        $query->execute(array($id_ETU));
        return $query->fetchAll();
    }

}