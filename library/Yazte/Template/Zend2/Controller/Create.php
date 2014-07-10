<?php $name = $params[0];
   $model = $name . 's';
   $controller = strtolower($model);
   // assuming the primary key name is id.
   unset($params[1]['id']);
   $len = count($params[1]);
   $elements = array_slice($params[1], 0, $len - 1);
   $last = end($params[1]);
?>
   public function createAction() {
      $form = new Application_Form_<?=$name ?>();
      $this->view->form = $form;
      if ($this->getRequest()->isPost()) {
         $formData = $this->getRequest()->getPost();
         if ($form->isValid($formData)) {
            $data = array(
<?php
   foreach($elements as $e):
      if ('int4' == $e['DATA_TYPE']): ?>
               '<?=$e['COLUMN_NAME'] ?>' => (int) $form->getValue('<?=$e['COLUMN_NAME'] ?>'),
<?php    else:?>
               '<?=$e['COLUMN_NAME'] ?>' => $form->getValue('<?=$e['COLUMN_NAME'] ?>'),
<?php    endif;
   endforeach;
   
   // the last one
   if ('int4' == $last['DATA_TYPE']): ?>
               '<?=$last['COLUMN_NAME'] ?>' => (int) $form->getValue('<?=$last['COLUMN_NAME'] ?>')
<?php else:?>
               '<?=$last['COLUMN_NAME'] ?>' => $form->getValue('<?=$last['COLUMN_NAME'] ?>')
<?php endif; ?>
            );
            $model = new Application_Model_DbTable_<?=$model ?>();
            try {
               $model->insert($data);
               $this->_helper->flashMessenger->addMessage(
                     array('success' => '<?=$name ?> successfully created.'));
               $this->_helper->redirector('index', '<?=$controller ?>', null, array());
            } catch(Exception $e) {
               $this->_helper->flashMessenger->addMessage(
                     array('error' => $e->getMessage()));
            }
         } else {
            $form->populate($formData);
         }
      }
   }
