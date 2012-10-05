<? $var = $params[0]; ?>

   protected function _<?=$var->getColumnName() ?>() {
      $e = new Zend_Form_Element_Textarea('<?=$var->getColumnName() ?>');
      $e->setLabel('<?=ucfirst($var->getColumnName()) ?>:')
<? if (false == $var->isNullable()): ?>
         ->setRequired(true)
<? endif; ?>
         ->setAttrib('rows', 10)
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
