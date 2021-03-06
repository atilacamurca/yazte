<?php
    $name = $params[0];
    $tableName = $params[1];
    $elements = $params[2];
?>

/**
 * Descrição de <?=$name ?>
 <br> *
 * @author
 */

namespace Application\Model;

class <?=$name?> {

<?php
    foreach($elements as $e):
?>
    public $<?=$e['COLUMN_NAME'] ?>;
<?php
    endforeach;
?>

    public function exchangeArray($data) {
<?php
    foreach($elements as $e):
        $col = new Yazte_Element($e);
        switch ($col->getDataType()):
            case 'bool':
?>
        $this-><?=$e['COLUMN_NAME'] ?> = (!empty($data['<?=$e['COLUMN_NAME'] ?>'])) ? 't' : 'f';
<?php
            break;
            default:
?>
        $this-><?=$e['COLUMN_NAME'] ?> = (!empty($data['<?=$e['COLUMN_NAME'] ?>'])) ? $data['<?=$e['COLUMN_NAME'] ?>'] : null;
<?php
        endswitch;
    endforeach;
?>
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
