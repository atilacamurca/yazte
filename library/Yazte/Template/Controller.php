<?php

class Yazte_Template_Controller extends Yazte_Template_Abstract {

    public function generate($tableName, $columns = array()) {
        $controller = $this->getFormName($tableName);
        $doc = $this->toControllerHeader($tableName);
        $doc .= $this->toIndexAction($tableName);
        $doc .= $this->toCreateAction($tableName);
        $doc .= $this->toUpdateAction($tableName);
        $doc .= $this->toDeleteAction($tableName);
        $doc .= "}\n";
        return $doc;
    }

    protected function toControllerHeader($tableName) {
        return $this->getTemplate('Controller/Header', array($this->getFormName($tableName), $tableName));
    }

    protected function toIndexAction($tableName) {
        return $this->getTemplate('Controller/Index', array($this->getFormName($tableName)));
    }

    protected function toCreateAction($tableName) {
        return $this->getTemplate('Controller/Create', array($this->getFormName($tableName), $tableName));
    }

    protected function toUpdateAction($tableName) {
        return $this->getTemplate('Controller/Update', array($this->getFormName($tableName), $tableName));
    }

    protected function toDeleteAction($tableName) {
        return $this->getTemplate('Controller/Delete', array($this->getFormName($tableName), $tableName));
    }
}
