<?php

class HomeModel{
    /**
     * 每个Model必备的构造函数，导入数据库链接
     * @param [object] $db [来自application]
     */
    function __construct($db){
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            echo("无法连接数据库");
        }
    }
    /**
     * 分辨输入的用户是谁，创建session，返回Controller的名字
     * 调用getInfo来访问数据库数据
     * @param  [type] $email [description]
     * @param  [type] $pwd   [description]
     * @return [type]        [description]
     */
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
                case 'SS':
                    return "ServiceScolarite";
                    break;
                default:
                    return "Responsable";
                    break;
            }
        }else{
            return "Home";
        }
    }
    /**
     * 从数据库中验证返回用户信息
     * @param  [type] $email [description]
     * @param  [type] $pwd   [description]
     * @return [type]        [description]
     */
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