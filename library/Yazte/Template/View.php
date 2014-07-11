<?php

class Yazte_Template_View extends Yazte_Template_Abstract {
    
    public function generate($tableName, $columns = array()) {
        $doc = "";
        
        $doc .= $this->toIndex($tableName, $columns);
        
        $doc .= $this->toSave($tableName, $columns);
        
        return $doc;
    }

    private function toIndex($tableName, $columns) {
        return $this->getTemplate('View/Index', array($this->getFormName($tableName), $tableName, $columns));
    }
    
    private function toSave($tableName, $columns) {
        return $this->getTemplate('View/Save', array($this->getFormName($tableName), $tableName, $columns));
    }
}
