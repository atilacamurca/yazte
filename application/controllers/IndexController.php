<?php

class IndexController extends Zend_Controller_Action
{

   public function init()
   {
      /* Initialize action controller here */
   }

   public function indexAction()
   {
		$projects = new Application_Model_DbTable_Projects();
      $show_hidden = $this->_getParam('show_hidden', 0);
      $rs = $projects->fetchAll('hide = ' . $show_hidden);

      // projects pagination
      $page = $this->_getParam('page', 1);

      $paginator = Zend_Paginator::factory($rs);
      $paginator->setCurrentPageNumber($page)
              ->setItemCountPerPage(9);

      Zend_Paginator::setDefaultScrollingStyle();
      Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
      $this->view->assign('paginator', $paginator);
      
      require_once "Yazte/Template.php";
      $template = Yazte_Template::factory("Form");
      $this->view->tables = $template->listTables();
   }

   public function aboutAction()
   {
      // just show a static page...
   }
}



