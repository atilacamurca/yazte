<?php
    $var = $params[0];
?>

    protected function _<?=$var->getColumnName() ?>() {
        $e = new Element\Checkbox('<?=$var->getColumnName() ?>');
        $e->setAttribute('id', '<?=$var->getColumnName() ?>');
        $e->setLabel('<?=$var->getLabel() ?>:');
        
        return $e;
    }
