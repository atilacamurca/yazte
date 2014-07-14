<?php
    $controller = $params[0];
    $tableName = $params[1];
?>

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\<?=$controller?>;
use Application\Form\<?=$controller?>Form;
use Application\Form\<?=$controller?>Filter;

class <?=$controller?> extends AbstractActionController {

    protected $<?=$tableName?>Table;

    public function get<?=$controller?>Table() {
        if (!$this-><?=$tableName?>Table) {
            $sm = $this->getServiceLocator();
            $this-><?=$tableName?>Table = $sm->get('Application\Model\<?=$controller?>Table');
        }
        return $this-><?=$tableName?>Table;
    }
