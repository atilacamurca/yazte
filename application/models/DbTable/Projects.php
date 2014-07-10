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

    public function getProject($id) {
        $query = $this->select();
        $query->setIntegrityCheck(false);
        $query->from(array('p' => 'projects'))
            ->join(array('a' => 'adapters'), 'p.adapter_id = a.id', array('adapter_name' => 'name'))
            ->where('p.id = ' . $id);
        $row = $this->fetchRow($query);
        return $row;
    }

    public function getDb($project) {
        $db = Yazte_Template::getAdapter($project->adapter_name, array(
            'host'     => $project->db_host,
            'username' => $project->db_username,
            'password' => $project->db_password,
            'dbname'   => $project->db_name,
        ));
        return $db;
    }
}
