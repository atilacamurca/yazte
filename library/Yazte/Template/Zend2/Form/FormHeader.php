<?php
    $name = $params[0];
    $tableName = $params[1];
    $elements = $params[2];
?>

&lt;?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de <?=$name ?>
 <br> *
 * @author
 */
class <?=$name ?> extends Form {

    public function __construct() {
        parent::__construct('<?=$tableName ?>');
        $this->setAttribute('method', 'post');

<?php
    foreach($elements as $e):
        if (! ('timestamp' == $e['DATA_TYPE'] and $e['DEFAULT']) ): ?>
        $this->add($this->_<?=$e['COLUMN_NAME'] ?>());
<?php
        endif;
    endforeach; ?>
        $this->add($this->_submit());
    }

    protected function _submit() {
        $e = new Element\Submit('submit');
        $e->setValue("Salvar")
            ->setAttribute("class", "btn btn-primary");
        return $e;
    }
