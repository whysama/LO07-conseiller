<?php
	#在数据库中创建EC USER ETU CONSEILLER LIEN*/

	include_once "configBD.php";
	include_once "sql.php";

	//链接数据库
	$base = new PDO ($dataSourceName,$user,$password);

	/**
	 * [getCSV 取回CSV数据]
	 * @param  [.csv] $filename [CSV表格]
	 * @return [array]          [数组形式返回]
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
	/**
	 * 组织语句，插入数据库
	 * @param  [string] $t     [表名]
	 * @param  [type] $table [数据数组]
	 */
	function insertSQL($t,$table){ //t表名
		foreach ($table as $key => $value) {
			global $base;
			$temp = "";
			foreach ($value as $v) {
				$temp = $temp."\"".$v."\",";
			}
			$temp = substr($temp,0,-1); //删除多余的逗号
			$sql = "INSERT INTO"." ".$t." "."VALUES(".$temp.")";	//构成INSERT语句
			$base->exec($sql);
		}
	}

	//创建表
	try{
		$base->beginTransaction();
		$base->exec($sql_create_USER);
		$base->exec($sql_create_ETU);
		$base->exec($sql_create_EC);
		$base->exec($sql_create_CONSEILLER);
		$base->exec($sql_create_LIEN);
		$base->commit();
	}catch(PDOException $e){
		$base->rollBack();
		echo ("Erreur!".$e->getMessage());
	}

	//插入数据
	//选择需要插入的数据，CSV格式
	$CSV = array(
				'EC' => "CSV/EC.csv",
				'ETU' => "CSV/ETU.csv",
				'USER' => "CSV/USER.csv",
				'CONSEILLER' => "CSV/CONSEILLER.csv"
	);
	//插入所有数据
	try{
		$base->beginTransaction();
		foreach ($CSV as $key => $value) {
			$table = getCSV($value);
			insertSQL($key,$table);
		}
		$base->commit();
	}catch(PDOException $e){
		$base->rollBack();
		echo ("Erreur!".$e->getMessage());
	}


?>