<? $name = $params[0];
   $model = $name . 's';
   $controller = strtolower($model);
   $view = strtolower($name);
?>
   public function deleteAction() {
      if ($this->getRequest()->isPost()) {
         $del = $this->getRequest()->getPost('del');
         if ("Ok" == $del) {
            $id = $this->getRequest()->getPost('id');
            $model = new Application_Model_DbTable_<?=$model ?>();
            try {
               $model->delete('id = ' . (int) $id);
               $this->_helper->flashMessenger->addMessage(
                    array('success' => '<?=$name ?> successfully deleted.'));
               $this->_helper->redirector('index', '<?=$controller ?>', null, array());
            } catch(Exception $e) {
               $this->_helper->flashMessenger->addMessage(
                     array('error' => $e->getMessage()));
            }
         }
      } else {
         $id = $this->_getParam('id', 0);
         $model = new Application_Model_DbTable_<?=$model ?>();
         $this->view-><?=$view ?> = $model->fetchRow('id = ' . $id)->toArray();
      }
   }
