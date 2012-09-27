<?php

class Application_Form_Project extends Zend_Form
{

   public function init()
   {
      $this->setName('project');

      $id = new Zend_Form_Element_Hidden('id');
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
      ));

                $submit = new Zend_Form_Element_Submit('submit');
                $submit->setAttrib('id', 'submitbutton')
                        ->setLabel('Save')
         ->setAttrib('class', 'btn btn-primary');

      $this->addElements(array($id, $name, $description, $hide, $submit));

      $this->addDisplayGroup(array('submit'), 'form_actions', array(
          'decorators' => array(
            'FormElements',
            'Fieldset',
            array('HtmlTag', array('tag' => 'div', 'class' => 'form-actions'))
          )
      ));
   }


}

