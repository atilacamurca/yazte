<? $name = $params[0];
   $model = $name . 's';
?>
   public function indexAction() {
      $model = new Application_Model_DbTable_<?=$model ?>();
      $rs = $model->fetchAll();
      
      // projects pagination
      $page = $this->_getParam('page', 1);

      $paginator = Zend_Paginator::factory($rs);
      $paginator->setCurrentPageNumber($page)
              ->setItemCountPerPage(10);

      Zend_Paginator::setDefaultScrollingStyle();
      Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
      $this->view->assign('paginator', $paginator);
   }
