<?php
    $var = $params[0];
?>

    protected function _<?=$var->getColumnName() ?>() {
        $e = new Element\Text('<?=$var->getColumnName() ?>');
        $e->setAttribute('id', '<?=$var->getColumnName() ?>');
        $e->setAttribute('class', 'form-control');
        $e->setLabel('<?=ucfirst($var->getColumnName()) ?>:');
        $e->setAttribute('readonly', 'readonly');

        return $e;
    }
