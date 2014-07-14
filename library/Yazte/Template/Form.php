<?php

require_once "Yazte/Template/Abstract.php";
require_once "Yazte/Element.php";

define("TODO", "&nbsp;\n// not implemented yet...\n");

class Yazte_Template_Form extends Yazte_Template_Abstract {

    public function generate($tableName, $columns = array()) {
        $doc = "";

        $doc .= $this->toFormHeader($tableName, $columns);

        foreach ($columns as $col) {
            $e = new Yazte_Element($col);

            switch ($e->getDataType()) {
                case 'int4':
                case 'int8':
                    if ($e->isPrimary()) {
                        $doc .= $this->toElementId($e);
                    } else if ($this->endsWith($e->getColumnName(), "_id")
                            or $this->startsWith($e->getColumnName(), "id_")) {
                        $doc .= $this->toElementSelect($e);
                    } else {
                        $doc .= $this->toElementNumeric($e);
                    }
                    break;
                case 'varchar':
                    $doc .= $this->toElementText($e);
                    break;
                case 'text':
                    $doc .= $this->toElementTextarea($e);
                    break;
                case 'timestamp':
                case 'date':
                    $doc .= $this->toElementTimestamp($e);
                    break;
                case 'numeric':
                    $doc .= $this->toElementNumeric($e);
                    break;
                case 'bool':
                    $doc .= $this->toElementBoolean($e);
                    break;
                default:
                    $doc .= TODO;
            }
        }

        $doc .= $this->toFormFooter();
        
        $doc .= $this->toFilterClass($tableName);

        return $doc;
    }

    protected function toFormHeader($tableName, $columns) {
        return $this->getTemplate('Form/FormHeader', array($this->toClassName($tableName, true), $tableName, $columns));
    }

    protected function toFormFooter() {
        return "}\n";
    }

    protected function toElementId(Yazte_Element $element) {
        return $this->getTemplate('Form/Id', array($element));
    }

    protected function toElementTextarea(Yazte_Element $element) {
        return $this->getTemplate('Form/Textarea', array($element));
    }

    protected function toElementText(Yazte_Element $element) {
        return $this->getTemplate('Form/Text', array($element));
    }

    protected function toElementSelect(Yazte_Element $element) {
        return $this->getTemplate('Form/Select', array($element));
    }

    protected function toElementTimestamp(Yazte_Element $element) {
        if ($element->isNullable()
                && $element->getDefault() != NULL) {
            return "";
        }
        return $this->getTemplate('Form/Timestamp', array($element));
    }
    
    protected function toElementNumeric(Yazte_Element $element) {
        return $this->getTemplate('Form/Numeric', array($element));
    }
    
    protected function toElementBoolean(Yazte_Element $element) {
        return $this->getTemplate('Form/Boolean', array($element));
    }
    
    protected function toFilterClass($tableName) {
        if (file_exists(realpath(dirname(__FILE__) . '/' . $this->_template . '/Filter'))) {
            return $this->getTemplate('Filter/Class', array($this->toClassName($tableName, true)));
        }
    }
}
