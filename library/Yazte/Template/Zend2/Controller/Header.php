<?php
    $className = $params[0];
    $varName = $params[1];
?>

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\<?=$className?>;
use Application\Form\<?=$className?>Form;
use Application\Form\<?=$className?>Filter;

class <?=$className?>Controller extends AbstractActionController {

    protected $<?=$varName?>Table;

    public function get<?=$className?>Table() {
        if (!$this-><?=$varName?>Table) {
            $sm = $this->getServiceLocator();
            $this-><?=$varName?>Table = $sm->get('Application\Model\<?=$className?>Table');
        }
        return $this-><?=$varName?>Table;
    }
