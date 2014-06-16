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

    public function ETU_ajout_liste($filename){
        require 'public/tools/tools.php';
        $etu = getCSV($filename);
        $sql_verifier = "SELECT * FROM ETU WHERE id_ETU = ?";
        $sql = "INSERT INTO ETU VALUE(?,?,?,?,?,?)";
        $query = $this->db->prepare($sql);
        $q = $this->db->prepare($sql_verifier);
        foreach ($etu as $etu) {
            $q->execute(array($etu[5]));
            if (empty($q->fetchAll())) {
                $query->execute($etu);
            }
        }
    }

    public function ETU_sans_conseiller($programme){
        if ($programme == "all" ) {
            $sql = "SELECT * FROM ETU WHERE id_ETU NOT IN (SELECT id_ETU FROM LIEN)";
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }else{
            $sql = "SELECT * FROM ETU WHERE id_ETU NOT IN (SELECT id_ETU FROM LIEN) AND programme = '".$programme."'";
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }
    }

    public function ETU_visualisation($programme){
        if ($programme == "all" ) {
            $sql = "SELECT * FROM ETU";
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }else{
            $sql = "SELECT * FROM ETU WHERE  programme = '".$programme."'";
            $query = $this->db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }
    }

    public function ETU_avec_conseiller_list ($programme){
            if ($programme == "All") {
                $sql = "SELECT EC.id_EC,ETU.programme,ETU.nom AS ETU_NOM, ETU.prenom AS ETU_PRENOM, EC.nom AS EC_NOM, EC.prenom AS EC_PRENOM
                        FROM ETU,LIEN,EC
                        WHERE LIEN.id_ETU = ETU.id_ETU
                        AND LIEN.id_EC=EC.id_EC";
                $query = $this->db->prepare($sql);
                $query->execute();
                return $query->fetchAll();
            }else{
                $sql = "SELECT EC.id_EC,ETU.programme,ETU.nom AS ETU_NOM, ETU.prenom AS ETU_PRENOM, EC.nom AS EC_NOM, EC.prenom AS EC_PRENOM
                        FROM ETU,LIEN,EC
                        WHERE LIEN.id_ETU = ETU.id_ETU
                        AND LIEN.id_EC=EC.id_EC
                        AND programme='".$programme."'";
                $query = $this->db->prepare($sql);
                $query->execute();
                return $query->fetchAll();
            }
        }

    public function ETU_suppression($id_ETU){
        $sql_drop_FK_l2 = "ALTER TABLE LIEN DROP FOREIGN KEY fk_id_ETU_l"; //删除LIEN的ETU外键
        $sql_add_FK_l2 = "ALTER TABLE LIEN ADD CONSTRAINT fk_id_ETU_l FOREIGN KEY (id_ETU) REFERENCES ETU(id_ETU)"; //重新建立外键
        $sql_delete_from_lien = "DELETE FROM LIEN WHERE id_ETU =".$id_ETU;
        $sql_delete_from_etu = "DELETE FROM ETU WHERE id_ETU=".$id_ETU;
        try {
            $this->db->beginTransaction();
            $this->db->exec($sql_drop_FK_l2);
            $this->db->exec($sql_delete_from_lien);
            $this->db->exec($sql_delete_from_etu);
            $this->db->exec($sql_add_FK_l2);
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "WRONG:".$e->getMessage();
        }
    }

    private function Lien_etudiants_decroissant($programme){
        $sql = "SELECT id_EC,COUNT(id_ETU) as num_id_etu FROM LIEN WHERE id_EC in(SELECT id_EC from CONSEILLER where LIEN.id_EC = CONSEILLER.id_EC and programme = '".$programme."') group by id_EC ORDER BY `num_id_etu`,id_EC ASC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function attribution_nouvel_etudiant($id_ETU){
        if (!$this->conseillerVerification($id_ETU)) {
            return false;
        }
        $sql_programme = "SELECT programme FROM ETU WHERE id_ETU=".$id_ETU;
        $query = $this->db->prepare($sql_programme);
        $query->execute();
        $programme = $query->fetchAll()[0]->programme;

        $sql = "SELECT DISTINCT id_EC, (SELECT count(id_ETU) FROM LIEN WHERE LIEN.id_EC = CONSEILLER.id_EC group by id_EC)AS num_etu FROM CONSEILLER WHERE programme = ? order by num_etu";
        $query = $this->db->prepare($sql);
        $query->execute(array($programme));
        $id_EC = $query->fetchAll()[0]->id_EC;
        $sql = "INSERT INTO LIEN VALUES('".$id_EC."','".$id_ETU."')";
        $query = $this->db->prepare($sql);
        $query->execute();
        return true;
    }
    /**
     * 确保存在某programmde的conseiller，已经被授权
     * @param  String $id_ETU [description]
     * @return Bool         [description]
     */
    public function conseillerVerification($id_ETU){
        $sql = "SELECT programme FROM ETU WHERE id_ETU = ? ";
        $query = $this->db->prepare($sql);
        $query->execute(array($id_ETU));
        $programme = $query->fetchAll()[0]->programme;

        $sql = "SELECT programme FROM CONSEILLER WHERE programme = ?";
        $query = $this->db->prepare($sql);
        $query->execute(array($programme));
        if (empty($query->fetchAll())) {
            return false;
        }else{
            return true;
        }
    }

    private function sqlFetch($sql){
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function attribution_nouveaux_etudiants(){
            $sql_count_etu = "SELECT programme,COUNT(id_ETU) as COUNT_ETU FROM ETU where id_ETU not in(select id_ETU from lien)  group by programme";
            $sql_count_con = "SELECT programme,COUNT(id_EC) as COUNT_CON FROM CONSEILLER GROUP BY programme";
            $count_etu = $this->sqlFetch($sql_count_etu);  //每个专业未被分配的学生有多少人
            $count_con = $this->sqlFetch($sql_count_con); //每个专业Con有多少人
            foreach ($count_con as $count_con) {    //每一个有conseiller的专业
                $programme = $count_con->programme;
                $c_con[$count_con->programme] = $count_con->COUNT_CON; //优化后的 统计各专业Con人数的数组
                $sql_con = "SELECT id_EC FROM CONSEILLER WHERE programme = '".$programme."'";
                $sql_etu = "SELECT id_ETU FROM ETU WHERE id_ETU not in(select id_ETU from lien) AND programme = '".$programme."'";
                $con[$programme] = $this->sqlFetch($sql_con);//$con[ISI] = array(0=>objet1,1=>objet2...) 某专业 全部CON
                $etu[$programme] = $this->sqlFetch($sql_etu);//未被分配的 某专业 全部ETU
                foreach ($count_etu as $count_etu_temp) {
                    if ($count_etu_temp->programme == $programme) {
                        $avr[$count_etu_temp->programme] = ceil($count_etu_temp->COUNT_ETU/$count_con->COUNT_CON);
                        $c_etu[$count_etu_temp->programme] = $count_etu_temp->COUNT_ETU;
                    }
                }
            }
            if (!isset($avr)) {
                return false;
            }
            //-----------------------------
            //var_dump($avr);
            //var_dump($con);
            //var_dump($count_con);
            //-----------------------------
            //开始分配
            foreach ($avr as $programme => $avr) {
                //$JiShu = 0; //计数器
                //非TC的 其他专业
                if ($programme != "TC") {
                    
                    $sql = "SELECT CONSEILLER.id_EC,num,programme FROM CONSEILLER LEFT JOIN (SELECT LIEN.id_EC, COUNT(LIEN.id_ETU) AS num FROM LIEN GROUP BY LIEN.id_EC) AS B ON B.id_EC = CONSEILLER.id_EC WHERE programme = '".$programme."' ORDER BY `B`.`num` ASC";
                    $query = $this->db->prepare($sql);
                    $query->execute();
                    $affiche_count = $query->fetchAll();
                    var_dump($affiche_count);
                    if (!empty($affiche_count)) {
                        $con[$programme] = $affiche_count;
                    }
                    
                    for ($i=0; $i < $avr; $i++) {       //共执行次数
                        for ($k=0; $k < $c_con[$programme] ; $k++) {  //对每一位Conseiller来说
                            $temp = array_shift($etu[$programme]); //弹出第一个学生
                            if ($temp != NULL) {
                                $id_ETU = $temp->id_ETU;
                                if ($id_ETU != NULL) {
                                    $id_EC = $con[$programme][$k]->id_EC;
                                    $sql = "INSERT INTO LIEN VALUES('".$id_EC."','".$id_ETU."')";
                                    //echo $i.$sql."<br>";
                                    //$i++;
                                    $query = $this->db->prepare($sql);
                                    $query->execute();
                                }
                            }
                        }
                    }
                }
                

                if ($programme == "TC") {
                    //TC专业分配
                    //三步
                    /*  第一步 1.找出LIEN中CON所带领学生个数的最小值
                                2.给CONSEILLER中其他被授权TC的CON按最小值分配学生加入LIEN
                        第二步 1.若还有剩余，按LIEN中CON所带领学生个数的最大值，填满所有CON
                        第三步 1.若还有剩余，计算剩余学生人数和每位CON需要轮到的次数
                                2.分配学生
                    */
                   
                    $affiche_count = $this->Lien_etudiants_decroissant($programme); //LIEN里授权TC的Con按学生数目的降序排列
                    
                    $min_conseiller = $affiche_count[0]->num_id_etu;//CON所带领最小的学生个数
                    $sql_con_tc = "SELECT id_EC FROM CONSEILLER WHERE id_EC NOT IN( SELECT id_EC FROM LIEN ) AND programme = '".$programme."'";
                    $con_tc = $this->sqlFetch($sql_con_tc);
                   // var_dump($con_tc);
                    $sql_count_con_tc = "SELECT COUNT(id_EC) as COUNT_EC FROM CONSEILLER where id_EC not in(select id_EC from lien) AND programme = '".$programme."'";
                    $count_con_tc = $this->sqlFetch($sql_count_con_tc)[0];
                    //var_dump($count_con_tc);
                    //--------------------------------
                    echo "Min";
                    var_dump($min_conseiller);
                    var_dump($con_tc);
                    var_dump($count_con_tc);
                    //第一步
                    if (!is_null($min_conseiller)) {
                        for ($i=0; $i < $min_conseiller; $i++) {
                            for ($k=0; $k < $count_con_tc->COUNT_EC; $k++) {
                                $temp = array_shift($etu[$programme]);
                                if ($temp != NULL) {
                                    $id_ETU = $temp->id_ETU;
                                    if ($id_ETU != NULL) {
                                        $id_EC = $con_tc[$k]->id_EC;
                                        $sql = "INSERT INTO LIEN VALUES('".$id_EC."','".$id_ETU."')";
                                        //echo $sql."<br>";
                                        $query = $this->db->prepare($sql);
                                        $query->execute();
                                    }
                                }
                            }
                        }
                    }

                    //第二步
                    if (current($etu[$programme])) {
                        $affiche_count = $this->Lien_etudiants_decroissant($programme);
                        //var_dump($affiche_count);
                        $max_conseiller = end($affiche_count)->num_id_etu;
                        //var_dump($max_conseiller);
                        reset($affiche_count);
                        //var_dump(current($affiche_count));

                        while(($num_id = current($affiche_count)->num_id_etu) < $max_conseiller) { //填补空缺
                            for ($i=$num_id; $i < $max_conseiller; $i++) {
                                $temp = array_shift($etu[$programme]);
                                if ($temp!=NULL) {
                                    $id_ETU = $temp->id_ETU;
                                    if ($id_ETU != NULL) {
                                        $id_EC = current($affiche_count)->id_EC;
                                        $sql = "INSERT INTO LIEN VALUES('".$id_EC."','".$id_ETU."')";
                                        //echo $sql."<br>";
                                        $query = $this->db->prepare($sql);
                                        $query->execute();
                                    }
                                }
                            }
                            next($affiche_count);
                        }
                        
                        //$affiche_count = $this->Lien_etudiants_decroissant($programme);
                        //
                        echo "!!!!!!!!!";
                        var_dump($affiche_count);
                        //var_dump($etu[$programme]);
                        //var_dump($con_tc);
                        //第三步
                        
                        if (current($etu[$programme])) {
                            $ec_rest = count($etu[$programme]); //剩余学生
                            $avr_tc = ceil($ec_rest/$c_con[$programme]);
                            var_dump($ec_rest);
                            var_dump($avr_tc);
                            for ($i=0; $i < $avr_tc; $i++) {        //共执行次数
                                for ($k=0; $k < $c_con[$programme] ; $k++) {  //对每一位Conseiller来说
                                    $temp = array_shift($etu[$programme]); //弹出第一个学生
                                    if ($temp!=NULL) {
                                        $id_ETU = $temp->id_ETU;
                                        if ($id_ETU != NULL) {
                                            $id_EC = $affiche_count[$k]->id_EC;
                                            $sql = "INSERT INTO LIEN VALUES('".$id_EC."','".$id_ETU."')";
                                            $query = $this->db->prepare($sql);
                                            $query->execute();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

    public function attribution_etudiant_transfert($id_ETU,$programme){
            $sql_update_p_s = "UPDATE ETU SET programme = '".$programme."', semestre = 1 WHERE id_ETU = ".$id_ETU;
            $sql_select_p = "SELECT CONSEILLER.programme FROM CONSEILLER,LIEN WHERE CONSEILLER.id_EC = LIEN.id_EC AND id_ETU = ".$id_ETU;
            $pro = $this->sqlFetch($sql_select_p);
            foreach ($pro as $conseiller) {
                if ( $conseiller->programme == $programme) {  //判断ETU的CON是否已被授权PROGRAMME
                    $exist = true;
                    break;
                }else{  //未被授权 对ETU修改学生 对LIEN先删再添
                    $exist = false;
                }
            }
            
            if ($exist) {
                $query = $this->db->prepare($sql_update_p_s);
                $query->execute();
            }else{
                $query = $this->db->prepare($sql_update_p_s);
                $query->execute();
                $sql_delete_from_lien = "DELETE FROM LIEN WHERE id_ETU=".$id_ETU;
                $query = $this->db->prepare($sql_delete_from_lien);
                $query->execute();
                $this->attribution_nouvel_etudiant($id_ETU);
            }
     }

    public function EC_visualisation_nombre_etudiants_decroissant(){
            $sql_LIEN = "SELECT EC.id_EC,prenom,nom,num FROM EC LEFT JOIN (SELECT LIEN.id_EC, COUNT(LIEN.id_ETU) AS num FROM LIEN GROUP BY LIEN.id_EC) AS B ON B.id_EC = EC.id_EC ORDER BY `B`.`num` DESC,`EC`.`id_EC` ASC";
            $query = $this->db->prepare($sql_LIEN);
            $query->execute();
            return $query->fetchAll();
    }

}