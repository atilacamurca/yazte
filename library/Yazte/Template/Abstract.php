<?php

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    '../../library',
    get_include_path(),
)));

require_once "Zend/Db.php";

abstract class Yazte_Template_Abstract {
   
   const TEST = "Hello abstract";
   
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
}
