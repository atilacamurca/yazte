<?php

class Application_Model_DbTable_Projects extends Zend_Db_Table_Abstract
{

   protected $_name = 'projects';
   protected $_referenceMap = array(
       'Project' => array(
           'refTableClass' => 'Application_Model_DbTable_Adapters',
           'refColumns' => array('id'),
           'columns' => array('adapter_id'),
           'onDelete' => self::CASCADE,
           'onUpdate' => self::RESTRICT
       )
   );

   public function getDb($id) {
      $query = $this->select();
      $query->setIntegrityCheck(false);
      $query->from(array('p' => 'projects'))
            ->join(array('a' => 'adapters'), 'p.adapter_id = a.id',
                  array('adapter_name' => 'name'))
            ->where('p.id = ' . $id);
      $row = $this->fetchRow($query);
      $db = Yazte_Template::getAdapter($row->adapter_name, array(
         'host'     => $row->db_host,
         'username' => $row->db_username,
         'password' => $row->db_password,
         'dbname'   => $row->db_name,
      ));
      return $db;
   }
}

