<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * Whenever a controller is created, open a database connection too. The idea behind is to have ONE connection
     * that can be used by multiple models (there are frameworks that open one connection per model).
     */
    function __construct()
    {
        $this->openDatabaseConnection();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_SOURCE. 'dbname=' . DB_NAME, DB_USER, DB_PASSWORD, $options);
    }

    /**
     * Load the model with the given name.
     * loadModel("SongModel") would include models/songmodel.php and create the object in the controller, like this:
     * $songs_model = $this->loadModel('SongsModel');
     * Note that the model class name is written in "CamelCase", the model's filename is the same in lowercase letters
     * @param string $model_name The name of the model
     * @return object model
     */
    public function loadModel($model_name)
    {
        require 'application/models/' . $model_name . '.php';
        // return new model (and pass the database connection to the model)
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
    //插入$table的数据到 $t表
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
