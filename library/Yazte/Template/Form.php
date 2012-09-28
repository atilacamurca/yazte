<?php

require_once "Yazte/Template/Abstract.php";
require_once "Yazte/Element.php";

class Yazte_Template_Form extends Yazte_Template_Abstract {
   
   public function toElementText(Yazte_Element $element) {
      $v = $this->getTemplate('Text', $element);
      return $v;
   }
}
