<?php

class Yazte_Template_Controller extends Yazte_Template_Abstract {
   
   public function generate($tableName, $columns = array()) {
      $controller = $this->getFormName($tableName) . 's';
      $doc = "class ${controller}Controller extends Zend_Controller_Action {\n\n";
      $doc .= $this->toIndexAction($tableName);
      $doc .= $this->toCreateAction($tableName, $columns);
      $doc .= $this->toUpdateAction($tableName, $columns);
      $doc .= $this->toDeleteAction($tableName);
      $doc .= "}\n";
      return $doc;
   }
   
   protected function toIndexAction($tableName) {
      return $this->getTemplate('Controller/Index', array($this->getFormName($tableName)));
   }
   
   protected function toCreateAction($tableName, $columns) {
      return $this->getTemplate('Controller/Create', array($this->getFormName($tableName), $columns));
   }
   
   protected function toUpdateAction($tableName, $columns) {
      return $this->getTemplate('Controller/Update', array($this->getFormName($tableName), $columns));
   }
   
   protected function toDeleteAction($tableName) {
      return $this->getTemplate('Controller/Delete', array($this->getFormName($tableName)));
   }
}
