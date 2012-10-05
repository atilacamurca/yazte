<?php

class Application_Form_Project extends Zend_Form
{

   public function init()
   {
      $this->setName('project');

      /*$id = new Zend_Form_Element_Hidden('id');
      $id->addFilter('Int');

      $name = new Zend_Form_Element_Text('name');
      $name->setLabel('Name')
                        ->setRequired(true)
                        ->addFilter('StripTags')
                        ->addFilter('StringTrim')
         ->setAttrib('class', 'span6');

      $name->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));

      $description = new Zend_Form_Element_Textarea('description');
      $description->setLabel('Description')
                        ->setRequired(true)
                        ->addFilter('StripTags')
                        ->addFilter('StringTrim')
                        ->setAttrib('rows', 10)
                        ->setAttrib('class', 'input-xlarge span6');

      $description->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));

      $hide = new Zend_Form_Element_Checkbox('hide');
      $hide->setLabel('Visibility')
              ->setRequired()
              ->setDescription('Hide or Show this project.')
              ->setDecorators(array(
                  'ViewHelper',
                  'Description',
                  'Errors',
                  array('HtmlTag', ''),
                  array('Label', ''),
                  array('Description', array('tag' => 'label', 'class' => 'checkbox inline')),
               ));*/

      $submit = new Zend_Form_Element_Submit('submit');
      $submit->setAttrib('id', 'submitbutton')
                        ->setLabel('Save')
                        ->setAttrib('class', 'btn btn-primary');

      $this->addElements(array(
         $this->_id(),
         $this->_name(),
         $this->_description(),
         $this->_hide(),
         $this->_adapter_id(),
         $this->_db_host(),
         $this->_db_username(),
         $this->_db_password(),
         $this->_db_name(),
         $submit
      ));

      $this->addDisplayGroup(array('submit'), 'form_actions', array(
          'decorators' => array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array('tag' => 'div', 'class' => 'form-actions'))
          )
      ));
   }

   protected function _id() {
      $e = new Zend_Form_Element_Hidden('id');
      $e->addFilter('Int');
      return $e;
   }
   
   protected function _name() {
      $e = new Zend_Form_Element_Text('name');
         $e->setLabel('Name:')
         ->setRequired(true)
         ->addValidator('StringLength', false, array(1, 20))
         ->addFilter('StripTags')
         ->addFilter('StringTrim')
         ->setAttrib('class', 'span4');
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
   
   protected function _description() {
      $e = new Zend_Form_Element_Textarea('description');
         $e->setLabel('Description:')
         ->setRequired(true)
         ->setAttrib('rows', 10)
         ->setAttrib('class', 'input-xlarge span6')
         ->addFilter('StripTags')
         ->addFilter('StringTrim');
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
   
   protected function _hide() {
      $hide = new Zend_Form_Element_Checkbox('hide');
      $hide->setLabel('Visibility')
              ->setDescription('Hide or Show this project.')
              ->setDecorators(array(
                  'ViewHelper',
                  'Description',
                  'Errors',
                  array('HtmlTag', ''),
                  array('Label', ''),
                  array('Description', array('tag' => 'label',
                     'class' => 'checkbox inline',
                     'for' => 'hide')
                  ),
               ));
      return $hide;
   }

   protected function _adapter_id() {
      $e = new Zend_Form_Element_Select('adapter_id');
         $e->setLabel('Adapter:')
         ->setRequired(true);
      
      $model = new Application_Model_DbTable_Adapters();
      $rs = $model->fetchAll(null, 'order ASC');
      foreach($rs as $row) {
         $e->addMultiOption($row->id, $row->description);
      }
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
   
   protected function _db_host() {
      $e = new Zend_Form_Element_Text('db_host');
         $e->setLabel('Db host:')
         ->setRequired(true)
         ->addValidator('StringLength', false, array(1, 100))
         ->addFilter('StripTags')
         ->addFilter('StringTrim')
         ->setAttrib('class', 'span6');
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
   
   protected function _db_username() {
      $e = new Zend_Form_Element_Text('db_username');
         $e->setLabel('Db username:')
         ->setRequired(true)
         ->addValidator('StringLength', false, array(1, 20))
         ->addFilter('StripTags')
         ->addFilter('StringTrim');
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
   
   protected function _db_password() {
      $e = new Zend_Form_Element_Password('db_password');
         $e->setLabel('Db password:')
         ->setRequired(true)
         ->addValidator('StringLength', false, array(1, 20))
         ->addFilter('StripTags')
         ->addFilter('StringTrim');
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
   
   protected function _db_name() {
      $e = new Zend_Form_Element_Text('db_name');
         $e->setLabel('Db name:')
         ->setRequired(true)
         ->addValidator('StringLength', false, array(1, 20))
         ->addFilter('StripTags')
         ->addFilter('StringTrim');
      
      $e->setDecorators(array(
         'ViewHelper',
         'Description',
         'Errors',
         array('HtmlTag', ''),
         array('Label', ''),
      ));
      return $e;
   }
}

