<? $var = $params[0]; ?>

   protected function _<?=$var->getColumnName() ?>() {
      $e = new Zend_Form_Element_Hidden('<?=$var->getColumnName() ?>');
      $e->addFilter('Int');
      return $e;
   }
