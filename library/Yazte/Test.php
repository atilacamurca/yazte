<?php

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    '../../library',
    get_include_path(),
)));

require_once "Zend/Db.php";

class Yazte_Test {
	
	function getTemplate($file, $vars = array()) {
		ob_start();
		if (file_exists($file)) {
			include($file);
		}
		return ob_get_clean();
	}
   
   function getAdapter() {
      $db = Zend_Db::factory('PDO_PGSQL', array(
                                                'host'     => 'localhost',
                                                'username' => 'postgres',
                                                'password' => 'postgres',
                                                'dbname'   => 'yazte'
                                            ));
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
$t = $test->listTables();
$test->listColumns('projects');
echo "\n";

