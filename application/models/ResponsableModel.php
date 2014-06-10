<?php

class ResponsableModel{
    /**
     * Responsable所在的programme
     */
    private $programme;


    public function getProgramme(){
        return $this->programme;
    }

    public function setProgramme($programme){
        $this->programme = $programme;
    }

    function __construct($db){
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            echo("无法连接数据库");
        }
    }

    /**
     * 从数据库获取responsable的信息
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    public function getInfo($email){
        $sql = "SELECT * FROM EC WHERE email = ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($email));
        return $query->fetchAll();
    }

    /**
     * 授权某EC到CONSEILLER表
     * @param [type] $id_EC [description]
     */
    public function Habilitation_ajout($id_EC){
        try {
            $sql = "INSERT INTO CONSEILLER VALUES(?,?)";
            $query = $this->db->prepare($sql);
            $query->execute(array($id_EC, $this->getProgramme()));
        } catch (PDOException $e) {
            echo ("插入出错！");
        }
    }

    /**
     * tous les EC de ce pole sont habilités automatiquement pour ce programme
     * @param [type] $pole [description]
     */
    public function Habilitation_par_pole($pole){
        $sql = "SELECT id_EC From EC
                        WHERE id_EC NOT IN(
                            SELECT id_EC
                            FROM CONSEILLER
                            WHERE programme = ? )
                    AND pole = ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($this->getProgramme(),$pole));
        foreach ($query->fetchAll() as $conseiller) {
            $sql = "INSERT INTO CONSEILLER  VALUES(?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($conseiller->id_EC,$this->getProgramme()));
        }
    }
    /**
     * 删除一个conseiller
     * @param [type] $id_EC [description]
     */
    public function Habilitation_suppression($id_EC){
        $sql_drop_FK_c1 = "ALTER TABLE CONSEILLER DROP FOREIGN KEY fk_id_EC_c";
        $sql_drop_FK_l1 = "ALTER TABLE LIEN DROP FOREIGN KEY fk_id_EC_l";
        $sql_delete_from_con = "DELETE FROM CONSEILLER WHERE id_EC = '".$id_EC."' AND programme ='".$this->getProgramme()."'";
        $sql_delete_from_lien = "DELETE FROM LIEN WHERE id_EC = '".$id_EC."' AND id_ETU IN (SELECT id_ETU FROM ETU WHERE programme ='".$this->getProgramme()."')";
        $sql_add_FK_c1 = "ALTER TABLE CONSEILLER ADD CONSTRAINT fk_id_EC_c FOREIGN KEY (id_EC) REFERENCES EC(id_EC)";
        $sql_add_FK_l1 = "ALTER TABLE LIEN ADD CONSTRAINT fk_id_EC_l FOREIGN KEY (id_EC) REFERENCES CONSEILLER(id_EC)";
        try {
            $this->db->beginTransaction();
            $this->db->exec($sql_drop_FK_l1);
            $this->db->exec($sql_drop_FK_c1);
            $this->db->exec($sql_delete_from_lien);
            $this->db->exec($sql_delete_from_con);
            $this->db->exec($sql_add_FK_l1);
            $this->db->exec($sql_add_FK_c1);
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo ("Erreur!".$e->getMessage());
        }
    }
    /**
     * 显示自己programme现在的conseiller
     */
    public function CONSEILLER_visualisation(){
        $sql = "SELECT C.id_EC,nom,prenom,email,bureau,pole,C.programme FROM EC INNER JOIN CONSEILLER AS C ON C.id_EC = EC.id_EC WHERE programme = ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($this->getProgramme()));
        return $query->fetchAll();
    }
    /**
     * 显示自己programme所有etu和他们的conseiller
     */
    public function Habilitation_visualisation_etu_ec(){
        $sql = "SELECT EC.id_EC,ETU.nom AS ETU_NOM, ETU.prenom AS ETU_PRENOM, EC.nom AS EC_NOM, EC.prenom AS EC_PRENOM
                FROM ETU,LIEN,EC
                WHERE LIEN.id_ETU = ETU.id_ETU
                AND LIEN.id_EC=EC.id_EC
                AND programme= ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($this->getProgramme()));
        return $query->fetchAll();
        }
    /**
     * 按pole显示EC
     * @param [type] $pole [description]
     */
    public function EC_visualisation($pole){
        if ($pole == "ALL") {
            $sql = "SELECT * FROM EC WHERE id_EC not in (SELECT id_EC FROM CONSEILLER WHERE programme = ? )";
            $query = $this->db->prepare($sql);
            $query->execute(array($this->getProgramme()));
            return $query->fetchAll();
        }else{
            $sql = "SELECT * FROM EC WHERE pole = ? AND id_EC not in (SELECT id_EC FROM CONSEILLER WHERE programme = ? )";
            $query = $this->db->prepare($sql);
            $query->execute(array($pole,$this->getProgramme()));
            return $query->fetchAll();
        }
    }

}