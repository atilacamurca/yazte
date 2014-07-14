<?php
    $name = $params[0];
    $tableName = $params[1];
    $elements = $params[2];
?>

/* ----------------------------------------------------------------- */
/*                     Classe Table                                  */
/* ----------------------------------------------------------------- */

/**
 * Descrição de <?=$name ?>
 <br> *
 * @author
 */

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class <?=$name ?>Table {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
         $this->tableGateway = $tableGateway;
    }

    public function listar() {
        $resultSet = $this->tableGateway->select();
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
?>
            '<?=$e['COLUMN_NAME'] ?>' => $<?=$tableName ?>-><?=$e['COLUMN_NAME'] ?>,
<?php
    endforeach;
?>
        );

        $id = (int) $<?=$tableName ?>->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            $this->tableGateway->update($data, array('id' => $id));
        }
    }

    public function deletar($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
