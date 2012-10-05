<?php

require_once "Yazte/Template/Abstract.php";
require_once "Yazte/Element.php";

define("TODO", "&nbsp;\n// not implemented yet...\n");

class Yazte_Template_Form extends Yazte_Template_Abstract {
   
   public function generate($tableName, $columns = array()) {
      $doc = "";
      
      $doc .= $this->toFormHeader($tableName, $columns);
      
      foreach($columns as $col) {
         $e = new Yazte_Element($col);
         
         switch ($col['DATA_TYPE']) {
         case 'int4':
            if ('id' == $col['COLUMN_NAME']) {
               $doc .= $this->toElementId($e);
            } else if ($this->endsWith($col['COLUMN_NAME'], "_id") or
                  $this->startsWith($col['COLUMN_NAME'], "id_")) {
               $doc .= $this->toElementSelect($e);
            } else {
               $doc .= TODO;
            }
            break;
         case 'varchar':
            $doc .= $this->toElementText($e);
            break;
         case 'text':
            $doc .= $this->toElementTextarea($e);
            break;
         default:
            $doc .= TODO;
         }
      }
      
      $doc .= $this->toFormFooter();
      
      return $doc;
   }
   
   protected function toFormHeader($tableName, $columns) {
      return $this->getTemplate('Form/FormHeader', array($this->getFormName($tableName), $columns));
   }
   
   protected function toFormFooter() {
      return "}\n";
   }
   
   protected function toElementId(Yazte_Element $element) {
      return $this->getTemplate('Form/Id', array($element));
   }
   
   protected function toElementTextarea(Yazte_Element $element) {
      return $this->getTemplate('Form/Textarea', array($element));
   }
   
   protected function toElementText(Yazte_Element $element) {
      return $this->getTemplate('Form/Text', array($element));
   }
   
   protected function toElementSelect(Yazte_Element $element) {
      return $this->getTemplate('Form/Select', array($element));
   }
}
