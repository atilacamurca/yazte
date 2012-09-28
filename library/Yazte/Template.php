<?php

class Yazte_Template {
   
   public static function factory($name) {
      
      if (!is_string($name) || empty($name)) {
         throw new Exception('Name must be specified in a string');
      }
      
      $adapterName = 'Yazte_Template_' . $name;
      
      /*
      * Load the adapter class.  This throws an exception
      * if the specified class cannot be loaded.
      */
      if (!class_exists($adapterName)) {
         require_once 'Zend/Loader.php';
         Zend_Loader::loadClass($adapterName);
      }
      
      $templateAdapter = new $adapterName();
      
      if (! $templateAdapter instanceof Yazte_Template_Abstract ) {
         throw new Exception("Adapter class '$templateAdapter' does not extend Yazte_Template_Abstract");
      }
      
      return $templateAdapter;
   }
}