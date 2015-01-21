<?php
    $name = $params[0];
    $tableName = $params[1];
    $route = str_replace('_', '-', $tableName);
    $viewName = ucwords(str_replace('_', ' ', $tableName));
?>

    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('<?=$route?>', array('action' => 'criar'));
        }

        try {
            $<?=$tableName?> = $this->get<?=$name?>Table()->buscar($id);
        }
        catch (\Exception $ex) {
            $this->messages()->flashWarning('<?=$viewName?> não encontrado(a).');
            return $this->redirect()->toRoute('<?=$route?>', array('action' => 'criar'));
        }

        $form  = new <?=$name?>Form();
        $form->bind($<?=$tableName?>);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $filter = new <?=$name?>Filter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                try {
                    $this->get<?=$name?>Table()->salvar($<?=$tableName?>);
                    $this->messages()->flashSuccess('<?=$viewName?> atualizado(a) com sucesso.');
                    return $this->redirect()->toRoute('<?=$route?>');
                } catch (\Exception $e) {
                    if (preg_match('/23505/', $e->getMessage())) {
                        $this->messages()->flashWarning('<?=$viewName?> já existe.');
                    } else {
                        $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                    }
                }
            }
        }

        $viewModel = new ViewModel(array(
            'id' => $id,
            'form' => $form,
            'title' => 'Editar <?=$viewName?>'
        ));
        $viewModel->setTemplate('application/<?=$route?>/salvar.phtml');
        
        return $viewModel;
    }
