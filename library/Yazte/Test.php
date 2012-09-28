<?php

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    '../../library',
    get_include_path(),
)));

require_once "Zend/Db.php";
//require_once "Zend/Db/Table.php";

class Yazte_Test {
	
	function getTemplate($file, $vars = array()) {
		ob_start();
		if (file_exists($file)) {
			include($file);
		}
		return ob_get_clean();
	}
   
   /*function getDefaultAdapter() {
      $dbAdapter = Zend_Db_Table::getDefaultAdapter();
      var_dump($dbAdapter);
   }*/
   
   function getAdapter() {
      $db = Zend_Db::factory('PDO_PGSQL', array(
                                                'host'     => 'localhost',
                                                'username' => 'postgres',
                                                'password' => 'postgres',
                                                'dbname'   => 'yazte'
                                            ));
      //var_dump($db);
      //$db->setFetchMode(Zend_Db::FETCH_OBJ);
      //$row = $db->fetchAll("select name from projects");
      
      //echo $row[0]->name;
      //echo "\n";
      return $db;
   }
   
   function listTables() {
      $tables = $this->getAdapter()->listTables();
      print_r($tables);
      return $tables;
   }
   
   function listColumns($table) {
      $columns = $this->getAdapter()->describeTable($table);
      print_r($columns);
   }
}

$test = new Yazte_Test();
//echo $test->getTemplate('file.php', array('var1' => 'atilacamurca'));
$t = $test->listTables();
$test->listColumns($t[0]);

echo true == null;