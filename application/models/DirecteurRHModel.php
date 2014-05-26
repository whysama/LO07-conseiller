<?php

class DirecteurRHModel{

    function __construct($db){
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('无法连接数据库');
        }
    }

    /**
     * 清空表EC ,需撤销外键和清空CONSEILLER以及LIEN
     */
    public function EC_vide(){
        $sql_vide_LIEN = "TRUNCATE TABLE LIEN";
        $sql_vide_CONSEILLER = "TRUNCATE TABLE CONSEILLER";
        $sql_drop_FK_c1 = "ALTER TABLE CONSEILLER DROP FOREIGN KEY fk_id_EC_c";
        $sql_drop_FK_l1 = "ALTER TABLE LIEN DROP FOREIGN KEY fk_id_EC_l";
        $sql = "TRUNCATE TABLE EC";
        $sql_add_FK_c1 = "ALTER TABLE CONSEILLER ADD CONSTRAINT fk_id_EC_c FOREIGN KEY (id_EC) REFERENCES EC(id_EC)";
        $sql_add_FK_l1 = "ALTER TABLE LIEN ADD CONSTRAINT fk_id_EC_l FOREIGN KEY (id_EC) REFERENCES CONSEILLER(id_EC)";
         try{
            $this->db->beginTransaction();
            $this->db->exec($sql_drop_FK_l1);   //删lien里的外键
            $this->db->exec($sql_vide_LIEN);    //清空lien
            $this->db->exec($sql_drop_FK_c1);   //删conseiller的外键
            $this->db->exec($sql_vide_CONSEILLER);//清空conseiller
            $this->db->exec($sql);              //清空EC
            $this->db->exec($sql_add_FK_l1);
            $this->db->exec($sql_add_FK_c1);
            $this->db->commit();
        }catch(PDOException $e){
            $this->db->rollBack();
            echo ("Erreur!".$e->getMessage());
        }
    }

    /**
     * 清空表EC ,需撤销外键和清空CONSEILLER以及LIEN
     * @param [type] $nom    姓
     * @param [type] $prenom 名
     * @param [type] $bureau 办公室
     * @param [type] $pole   部门
     */
     public function EC_ajout($nom,$prenom,$bureau,$pole){
        $sql = "SELECT nom,prenom FROM EC";
        $query = $this->db->prepare($sql);
        $query->execute();
        foreach ($query as $ec) {
            if ($ec->nom == $nom && $ec->prenom == $prenom) {
                echo "l'enseignant-chercheur ".$prenom." ".$nom." est déjà existé.";
                return false;
            }
        }
        $email = $prenom.".".$nom."@utt.fr";
        $temp = "\"".$nom."\",\"".$prenom."\",\"".$email."\",\"".$bureau."\",\"".$pole."\"";
        $sql = "INSERT INTO EC VALUES(NULL,".$temp.")";
        $query = $this->db->prepare($sql);
        $query->execute();
        return true;
    }

    /**
     * 按照CSV添加到EC
     * @param String $filename CSV文件名
     */
    public function EC_ajout_liste($filename){
        require 'public/tools/tools.php';
        $ec = getCSV($filename);
        //echo "<pre>";
        //var_dump($ec);
        $sql = "INSERT INTO EC VALUES(?,?,?,?,?,?)";
        $query = $this->db->prepare($sql);
        foreach ($ec as $value) {
            $query->execute($value);
        }
    }

    public function EC_visualisation(){
        $sql = "SELECT * FROM EC ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}