<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlashMessages
 *
 * @author atila
 */
class Zend_View_Helper_FlashMessages extends Zend_View_Helper_Abstract {

   public function flashMessages() {
      $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getMessages();
      $messages = array_merge( $messages,
         Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getCurrentMessages()
      );
      $output = '';

      if (!empty($messages)) {
         foreach ($messages as $message) {
            $output .= '<div class="alert fade in alert-' . key($message) . '">';
            $output .= '<a class="close" data-dismiss="alert" href="#">×</a>';
            $output .= '<h4 class="alert-heading">';
            switch (key($message)) {
               case 'block':
                  $output .= 'Be careful!';
                  break;
               case 'info':
                  $output .= 'Heads up!';
                  break;
               case 'error':
                  $output .= 'Oh snap!';
                  break;
               case 'success':
                  $output .= 'Well Done!';
                  break;
            }
            $output .= '</h4>'. current($message) . '</div>';
         }
      }
      return $output;
   }
}

?>
