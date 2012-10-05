<? $name = $params[0];
   $elements = $params[1];
?>
class Application_Form_<?=$name ?> extends Zend_Form {

   public function init() {
      $this->setName('<?=$name ?>');
      
      $submit = new Zend_Form_Element_Submit('submit')
         ->setLabel('Salvar');
      
      $this->addElements(array(
<? foreach($elements as $e): ?>
         $this->_<?=$e['COLUMN_NAME'] ?>(),
<? endforeach; ?>
         $submit
      ));
   }
