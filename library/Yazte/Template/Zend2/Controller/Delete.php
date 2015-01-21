<?php
    $name = $params[0];
    $tableName = $params[1];
    $route = str_replace('_', '-', $tableName);
    $viewName = ucwords(str_replace('_', ' ', $tableName));
?>

    public function deletarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $this->get<?=$name?>Table()->deletar($id);
            $this->messages()->flashSuccess('<?=$viewName?> deletado(a) com sucesso.');
        } catch (\Exception $e) {
            if (preg_match('/23503/', $e->getMessage())) {
                $this->messages()->flashWarning('<?=$viewName?> é referenciado(a) e não pode ser deletado(a).');
            } else {
                $this->messages()->flashError('Ocorreu um erro ao deletar. Detalhes: ' . $e->getMessage());
            }
        }
        $this->redirect()->toRoute('<?=$route?>');
    }
