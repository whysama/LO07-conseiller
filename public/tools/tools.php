<?php
    /**
     * 获取CSV数据，以数组形式返回
     * @param  String $filename
     * @return Array $table
     */
    function getCSV($filename){
        $table = array();
        $file = fopen($filename, "r");
        do{
            $table[] = fgetcsv($file);
        }while(! feof($file));
        array_pop($table);
        fclose($file);
        return $table;
    }

