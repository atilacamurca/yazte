<?php
    $var = $params[0];
?>

    protected function _<?=$var->getColumnName() ?>() {
        $e = new Element\Text('<?=$var->getColumnName() ?>');
        $e->setAttribute('id', '<?=$var->getColumnName() ?>');
        $e->setLabel('<?=(! $var->isNullable() ? '* ': '')?><?=ucfirst($var->getColumnName()) ?>:');
        $e->setAttribute('class', 'form-control date');

        return $e;
    }
