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
        return $this->getTemplate('Controller/Header', array(
            $this->toClassName($tableName, true),
            $this->toClassName($tableName, false)
        ));
    }

    protected function toIndexAction($tableName) {
        return $this->getTemplate('Controller/Index', array($this->toClassName($tableName, true)));
    }

    protected function toCreateAction($tableName) {
        return $this->getTemplate('Controller/Create', array($this->toClassName($tableName, true), $tableName));
    }

    protected function toUpdateAction($tableName) {
        return $this->getTemplate('Controller/Update', array($this->toClassName($tableName, true), $tableName));
    }

    protected function toDeleteAction($tableName) {
        return $this->getTemplate('Controller/Delete', array($this->toClassName($tableName, true), $tableName));
    }
}
