<?php

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    '../../library',
    get_include_path(),
)));

require_once "Zend/Db.php";

abstract class Yazte_Template_Abstract {
   
   protected $_template;
   protected $_db;
   
   public function __construct($db, $template = "Default") {
      $this->_template = $template;
      $this->_db = $db;
   }
   
   public function listTables() {
      $tables = $this->_db->listTables();
      return $tables;
   }
   
   public function getTableColumns($table) {
      $columns = $this->_db->describeTable($table);
      return $columns;
   }
   
   protected function getFormName($tableName) {
      $len = strlen($tableName);
      return ucfirst( substr($tableName, 0, $len - 1) );
   }
   
   protected function endsWith($string, $end) {
      $length = strlen($end);
      if ($length == 0) {
         return true;
      }
      return (substr($string, -$length) === $end);
   }
   
   protected function startsWith($string, $start) {
      $length = strlen($start);
      return (substr($string, 0, $length) === $start);
   }
   
   protected function getTemplate($file, $params = array()) {
      ob_start();
      if(file_exists(realpath(dirname(__FILE__) . "/$this->_template/$file.php"))) {
			include(realpath(dirname(__FILE__) . "/$this->_template/$file.php"));
		}
		return ob_get_clean();
   }
   
   abstract protected function generate($tableName, $columns = array());
}
