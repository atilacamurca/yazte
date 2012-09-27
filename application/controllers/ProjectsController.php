<?php

class ProjectsController extends Zend_Controller_Action
{

   public function init()
   {
      /* Initialize action controller here */
   }

   public function indexAction()
   {
      // action body
   }

   public function createAction()
   {
      $form = new Application_Form_Project();
      $form->setDecorators(array('FormElements', 'Form'));
      $this->view->form = $form;

      if ($this->getRequest()->isPost()) {
         $formData = $this->getRequest()->getPost();
         if ($form->isValid($formData)) {
            $data = array(
					'name' => $form->getValue('name'),
					'description' => $form->getValue('description')
            );
            $projects = new Application_Model_DbTable_Projects();
            $projects->insert($data);
            
            /*$name = $form->getValue('name');
            $description = $form->getValue('description');
            
            $projects->createProject($name, $description);*/

            $this->_helper->flashMessenger->addMessage(
                    array('success' => 'Project successfully created.'));

            $this->_helper->redirector('index', 'index', null, array());
         } else {
            $form->populate($formData);
         }
      }
   }


}



