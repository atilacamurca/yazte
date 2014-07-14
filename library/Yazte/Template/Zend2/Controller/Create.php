<?php
    $name = $params[0];
    $tableName = $params[1];
?>

    public function criarAction() {
        $form = new <?=$name?>Form();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $<?=$tableName?> = new <?=$name?>();
            $filter = new <?=$name?>Filter();
            $form->setInputFilter($filter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $<?=$tableName?>->exchangeArray($form->getData());
                try {
                    $this->get<?=$name?>Table()->salvar($<?=$tableName?>);
                    $this->messages()->flashSuccess('<?=$name?> criado(a) com sucesso.');
                    return $this->redirect()->toRoute('<?=$tableName?>-index');
                } catch (\Exception $e) {
                    $this->messages()->flashError('Ocorreu um erro ao criar. Detalhes: ' . $e->getMessage());
                }
            }
        }
        return array('form' => $form);
    }
