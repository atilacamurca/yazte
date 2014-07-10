<? $name = $params[0];
   $model = $name . 's';
   $controller = strtolower($model);
   // assuming the primary key name is id.
   unset($params[1]['id']);
   $len = count($params[1]);
   $elements = array_slice($params[1], 0, $len - 1);
   $last = end($params[1]);
?>
   public function updateAction() {
      $form = new Application_Form_<?=$name ?>();
      $this->view->form = $form;
      if ($this->getRequest()->isPost()) {
         $formData = $this->getRequest()->getPost();
         if ($form->isValid($formData)) {
            $id = (int) $form->getValue('id');
            $data = array(
<?
   foreach($elements as $e):
      if ('int4' == $e['DATA_TYPE']): ?>
               '<?=$e['COLUMN_NAME'] ?>' => (int) $form->getValue('<?=$e['COLUMN_NAME'] ?>'),
<?    else:?>
               '<?=$e['COLUMN_NAME'] ?>' => $form->getValue('<?=$e['COLUMN_NAME'] ?>'),
<?    endif;
   endforeach;
   
   // the last one
   if ('int4' == $last['DATA_TYPE']): ?>
               '<?=$last['COLUMN_NAME'] ?>' => (int) $form->getValue('<?=$last['COLUMN_NAME'] ?>')
<? else:?>
               '<?=$last['COLUMN_NAME'] ?>' => $form->getValue('<?=$last['COLUMN_NAME'] ?>')
<? endif; ?>
            );
            $model = new Application_Model_DbTable_<?=$model ?>();
            try {
               $model->update($data, 'id = ' . $id);
               $this->_helper->flashMessenger->addMessage(
                    array('success' => '<?=$name ?> successfully updated.'));
               $this->_helper->redirector('index', '<?=$controller ?>', null, array());
            } catch(Exception $e) {
               $this->_helper->flashMessenger->addMessage(
                     array('error' => $e->getMessage()));
            }
         } else {
            $form->populate($formData);
         }
      } else {
         $id = $this->_getParam('id', 0);
         if ($id > 0) {
            $model = new Application_Model_DbTable_<?=$model ?>();
            $form->populate($model->fetchRow('id = ' . $id)->toArray());
         }
      }
   }
