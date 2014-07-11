<?php

class ProjectsController extends Zend_Controller_Action {

    public function init() {
    }

    public function indexAction() {
    }

    public function createAction() {
        $form = new Application_Form_Project();
        $form->setDecorators(array('FormElements', 'Form'));
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $data = array(
                    'name' => $form->getValue('name'),
                    'description' => $form->getValue('description'),
                    'hide' => (int) $form->getValue('hide'),
                    'adapter_id' => (int) $form->getValue('adapter_id'),
                    'db_host' => $form->getValue('db_host'),
                    'db_username' => $form->getValue('db_username'),
                    'db_password' => $form->getValue('db_password'),
                    'db_name' => $form->getValue('db_name')
                );
                $model = new Application_Model_DbTable_Projects();
                try {
                    $model->insert($data);
                    $this->_helper->flashMessenger->addMessage(
                            array('success' => 'Project successfully created.'));
                    $this->_helper->redirector('index', 'index', null, array());
                } catch (Exception $e) {
                    $this->_helper->flashMessenger->addMessage(
                            array('error' => $e->getMessage()));
                }
            } else {
                $form->populate($formData);
            }
        }
    }

    public function showAction() {
        $id = $this->_getParam('id', 0);
        $model = new Application_Model_DbTable_Projects();
        $project = $model->getProject($id);
        // projects pagination
        $page = $this->_getParam('page', 1);

        $tables = Yazte_Template::listTables($model->getDb($project));
        $paginator = Zend_Paginator::factory($tables);
        $paginator->setCurrentPageNumber($page)
                ->setItemCountPerPage(10);

        Zend_Paginator::setDefaultScrollingStyle();
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
        $this->view->assign('paginator', $paginator);
    }

    public function formAction() {
        $table = $this->_getParam('table', 'none');
        $id = $this->_getParam('id', 0);
        $model = new Application_Model_DbTable_Projects();
        $project = $model->getProject($id);

        $template = Yazte_Template::factory("Form", $model->getDb($project), $project->template);
        $cols = $template->getTableColumns($table);
        if (!empty($cols)) {
            $this->view->code = $template->generate($table, $cols);
        } else {
            $this->_helper->flashMessenger->addMessage(
                    array('error' => "Table <strong>$table</strong> not found."));
        }
    }

    public function controllerAction() {
        $this->helper("Controller");
    }

    public function modelAction() {
        $this->helper("Model");
    }
    
    public function viewAction() {
        $this->helper("View");
    }

    private function helper($layer) {
        $table = $this->_getParam('table', 'none');
        $id = $this->_getParam('id', 0);
        $model = new Application_Model_DbTable_Projects();
        $project = $model->getProject($id);

        $template = Yazte_Template::factory($layer, $model->getDb($project), $project->template);
        $cols = $template->getTableColumns($table);
        if (!empty($cols)) {
            $this->view->code = $template->generate($table, $cols);
        } else {
            $this->_helper->flashMessenger->addMessage(
                    array('error' => "Table <strong>$table</strong> not found."));
        }
    }

}
