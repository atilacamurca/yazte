<?php
    $tableName = $params[0];
?>

    public function indexAction() {
        return new ViewModel(array(
            'list' => $this->get<?=$tableName?>Table()->listar(),
        ));
    }
