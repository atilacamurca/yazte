<?php

class Yazte_Template_Model extends Yazte_Template_Abstract {
    
    public function generate($tableName, $columns = array()) {
        $doc = "";
        
        $doc .= $this->toModel($tableName, $columns);
        
        $doc .= $this->toModelTable($tableName, $columns);
        
        $doc .= $this->toModule($tableName, $columns);
        
        return $doc;
    }
    
    protected function toModel($tableName, $columns) {
        return $this->getTemplate('Model/Model', array($this->getFormName($tableName), $tableName, $columns));
    }
    
    protected function toModelTable($tableName, $columns) {
        return $this->getTemplate('Model/ModelTable', array($this->getFormName($tableName), $tableName, $columns));
    }
    
    protected function toModule($tableName) {
        return $this->getTemplate('Model/Module', array($this->getFormName($tableName), $tableName));
    }
}