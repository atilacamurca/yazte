<? $var = $params[0]; ?>

   protected function _<?=$var->getColumnName() ?>() {
      $e = new Zend_Form_Element_Text('<?=$var->getColumnName() ?>');
      $e->setLabel('<?=$var->getLabel() ?>:')
<? if (false == $var->isNullable()): ?>
         ->setRequired(true)
<? endif; ?>
<? if (true == $var->getLength()): ?>
         ->addValidator('StringLength', false, array(1, <?=$var->getLength() ?>))
<? endif; ?>
         ->addFilter('StripTags')
         ->addFilter('StringTrim');
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
