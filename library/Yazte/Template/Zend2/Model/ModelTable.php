<?php
    $name = $params[0];
    $tableName = $params[1];
    $elements = $params[2];
?>

/* ----------------------------------------------------------------- */
/*                     Classe Table                                  */
/* ----------------------------------------------------------------- */

/**
 * Descrição de <?=$name ?>Table
 *
 * @author
 */

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class <?=$name ?>Table {

    protected $tableGateway;
    protected $_sequence = '<?=$tableName ?>_id_seq';

    public function __construct(TableGateway $tableGateway) {
         $this->tableGateway = $tableGateway;
    }

    public function listar() {
        $select = new Select($this->tableGateway->getTable());
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function buscar($id) {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Cód. $id não encontrado.");
        }
        return $row;
    }

    public function salvar(<?=$name ?> $<?=$tableName ?>) {
        $data = array(
<?php
    foreach($elements as $e):
        $col = new Yazte_Element($e);
        if (! $col->isPrimary()):
?>
            '<?=$col->getColumnName() ?>' => $<?=$tableName ?>-><?=$col->getColumnName() ?>,
<?php
        endif;
    endforeach;
?>
        );

        $id = (int) $<?=$tableName ?>->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            return $this->tableGateway->getAdapter()->getDriver()->getLastGeneratedValue($this->_sequence);
        } else {
            $this->tableGateway->update($data, array('id' => $id));
        }
    }

    public function deletar($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
