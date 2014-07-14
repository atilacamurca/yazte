<?php
    $var = $params[0];
?>

    protected function _<?=$var->getColumnName() ?>() {
        $e = new Element\Text('<?=$var->getColumnName() ?>');
        $e->setLabel('<?=(! $var->isNullable() ? '* ': '')?><?=$var->getLabel() ?>:');
        $e->setAttribute('id', '<?=$var->getColumnName() ?>');
        $e->setAttribute('class', 'form-control numeric');

        return $e;
    }
