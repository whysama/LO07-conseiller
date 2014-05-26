<?php

class ServiceScolariteModel {

    function __construct($db){
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            echo "无法链接数据库";;
        }
    }

    public function ETU_vide(){
        $sql_drop_FK_l2 = "ALTER TABLE LIEN DROP FOREIGN KEY fk_id_ETU_l"; //删除LIEN的ETU外键
        $sql_vide_LIEN = "TRUNCATE TABLE LIEN"; //清空LIEN
        $sql_vide_ETU = "TRUNCATE TABLE ETU";   //清空ETU
        $sql_add_FK_l2 = "ALTER TABLE LIEN ADD CONSTRAINT fk_id_ETU_l FOREIGN KEY (id_ETU) REFERENCES ETU(id_ETU)"; //重新建立外键
        try {
            $this->db->beginTransaction();
            $this->db->exec($sql_drop_FK_l2);
            $this->db->exec($sql_vide_LIEN);
            $this->db->exec($sql_vide_ETU);
            $this->db->exec($sql_add_FK_l2);
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "错误：".$e->getMessage();
        }
    }

    public function ETU_ajout($nom,$prenom,$programme,$semestre){
            $sql = "SELECT nom,prenom FROM ETU";
            $query = $this->db->prepare($sql);
            $query->execute();
            foreach ($query->fetchAll() as $etu) {
                if ($etu->nom == $nom && $etu->prenom == $prenom) {
                    echo "l'etudiant ".$prenom." ".$nom." est déjà existé.";
                    return false;
                }
            }
             $email = $prenom.".".$nom."@utt.fr";
             $sql = "INSERT INTO ETU VALUES(?,?,?,?,?,NULL)";
             $query = $this->db->prepare($sql);
             $query->execute(array($nom,$prenom,$email,$programme,$semestre));
             return true;
        }
}