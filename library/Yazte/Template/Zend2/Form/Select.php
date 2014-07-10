<?php
    $var = $params[0];
?>

    protected function _<?=$var->getColumnName() ?>() {
        $e = new Element\Select('<?=$var->getColumnName() ?>');
        $e->setLabel('<?=(! $var->isNullable() ? '* ': '')?><?=ucfirst($var->getColumnName()) ?>:');
        
        $model = new TableGateway('TABLE', $this->dbAdapter);
        $select = new Select();
        // $select->columns(array('id', 'value'));
        $select->from('TABLE');
        // $select->order('COLUNA ASC');
        $rowset = $model->selectWith($select);
        $options = array();
        foreach ($rowset as $row) {
            // $options[$row['id']] = $row['value'];
        }
        $e->setValueOptions($options);
        
        return $e;
    }
