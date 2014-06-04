<?php

/**
 * Controller 的基类
 */
class Controller
{
    /**
     * 数据库对象实例
     * @var [object]
     */
    public $db = null;

    /**
     * 构造函数，调用openDatabaseConnecton()来创建数据库链接。
     */
    function __construct()
    {
        $this->openDatabaseConnection();
    }

    /**
     * PDO链接数据库
     */
    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $this->db = new PDO(DB_SOURCE. 'dbname=' . DB_NAME, DB_USER, DB_PASSWORD, $options);
    }

    /**
     * 实力化model
     * @param  [String] $model_name [Mode的名称]
     * @return [Object]             [新建实例]
     */
    public function loadModel($model_name)
    {
        require 'application/models/' . $model_name . '.php';
        return new $model_name($this->db);
    }

    //获取CSV文件内数据 以数组形式返回
    public function getCSV($filename){
        $table = array();
        $file = fopen($filename, "r");
        do{
            $table[] = fgetcsv($file);
        }while(! feof($file));
        array_pop($table);
        fclose($file);
        return $table;
    }

    //插入$table的数据到 $t表 搭配get CSV
    function insertTo($t,$table){ //t表名
        foreach ($table as $key => $value) {
            $temp = "";
            foreach ($value as $v) {
                $temp = $temp."\"".$v."\",";
            }
            $temp = substr($temp,0,-1); //删除多余的逗号
            $sql = "INSERT INTO"." ".$t." "."VALUES(".$temp.")";    //构成INSERT语句
            $query = $this->db->prepare($sql);
            $query->execute();
        }
    }


}
