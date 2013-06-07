<? $name = $params[0];
   $tableName = $params[1];
   $elements = $params[2];
?>
class Application_Form_<?=$name ?> extends Zend_Form {

   public function init() {
      $this->setName('<?=$tableName ?>');
      
      $submit = new Zend_Form_Element_Submit('submit')
         ->setLabel('Salvar')
         ->setAttrib('class', 'btn btn-primary');
      
      $cancel = new Zend_Form_Element_Button('cancel')
         ->setLabel('Cancelar')
         ->setAttrib('class', 'btn');
      
      $this->addElements(array(
<? foreach($elements as $e):
      if (! ('timestamp' == $e['DATA_TYPE'] and $e['DEFAULT']) ): ?>
         $this->_<?=$e['COLUMN_NAME'] ?>(),
<?    endif;
   endforeach; ?>
         $submit
      ));
      
      $this->addDisplayGroup(array('cancel', 'submit'), 'form_actions', array(
          'decorators' => array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array('tag' => 'div', 'class' => 'form-actions'))
          )
      ));
   }
