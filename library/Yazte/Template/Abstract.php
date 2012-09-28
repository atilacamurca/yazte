<?php

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    '../../library',
    get_include_path(),
)));

require_once "Zend/Db.php";

abstract class Yazte_Template_Abstract {
   
   const TEST = "Hello abstract";
   protected $_template;
   //protected $_resource;
   
   public function __construct($template = "Default") {
      //$this->_resource = $resource;
      $this->_template = $template;
   }
   
   protected function getAdapter() {
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
   
   public function listTables() {
      $tables = $this->getAdapter()->listTables();
      //print_r($tables);
      return $tables;
   }
   
   public function getTableColumns($table) {
      $columns = $this->getAdapter()->describeTable($table);
      return $columns;
   }
   
   protected function getTemplate($file, $var) {
      //print_r(file_exists(realpath(dirname(__FILE__) . '/Default/Text.php')));
      ob_start();
		//if (file_exists('Template/' . $this->_template . '/' . $file . '.php')) {
      if(file_exists(realpath(dirname(__FILE__) . "/$this->_template/$file.php"))) {
			include(realpath(dirname(__FILE__) . "/$this->_template/$file.php"));
		}
		return ob_get_clean();
   }
}
