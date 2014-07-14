<?php
    $var = $params[0];
?>

    protected function _<?=$var->getColumnName() ?>() {
        $e = new Element\Textarea('<?=$var->getColumnName() ?>');
        $e->setLabel('<?=(! $var->isNullable() ? '* ': '')?><?=ucfirst($var->getColumnName()) ?>:');
        $e->setAttribute('id', '<?=$var->getColumnName() ?>');
        $e->setAttrib('rows', 4);
        // $e->setAttrib('cols', 30);
        $e->setAttribute('class', 'form-control');

        return $e;
    }
