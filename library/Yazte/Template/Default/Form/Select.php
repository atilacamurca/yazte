<? $var = $params[0]; ?>

   protected function _<?=$var->getColumnName() ?>() {
      $e = new Zend_Form_Element_Select('<?=$var->getColumnName() ?>');
      $e<? if (false == $var->isNullable()): ?>
->setRequired(true)
<? endif; ?>
         ->setLabel('<?=ucfirst($var->getColumnName()) ?>:');
      return $e;
   }
