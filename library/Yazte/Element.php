<?php

class Yazte_Element {
   
   /**
    * Example column
    * [name] => Array
        (
            [SCHEMA_NAME] => public
            [TABLE_NAME] => projects
            [COLUMN_NAME] => name
            [COLUMN_POSITION] => 2
            [DATA_TYPE] => varchar
            [DEFAULT] => 
            [NULLABLE] => 
            [LENGTH] => 20
            [SCALE] => 
            [PRECISION] => 
            [UNSIGNED] => 
            [PRIMARY] => 
            [PRIMARY_POSITION] => 
            [IDENTITY] => 
        )

    */
   
   /**
    * @var string
    */
   private $_tableName;
   
   /**
    * @var string
    */
   private $_columnName;
   
   /**
    * @var string
    */
   private $_dataType;
   
   /**
    * @var string
    */
   private $_default;
   
   /**
    * @var boolean
    */
   private $_nullable;
   
   /**
    * @var integer
    */
   private $_length;
   
   /**
    * @var integer
    */
   private $_precision;
   
   /**
    * @var boolean
    */
   private $_primary;
   
   public function __construct($array) {
      $this->_tableName    = $array['TABLE_NAME'];
      $this->_columnName   = $array['COLUMN_NAME'];
      $this->_dataType     = $array['DATA_TYPE'];
      $this->_default      = $array['DEFAULT'];
      $this->_nullable     = $array['NULLABLE'];
      $this->_length       = $array['LENGTH'];
      $this->_precision    = $array['PRECISION'];
      $this->_primary      = $array['PRIMARY'];
   }
   
   public function getTableName() {
      return $this->_tableName;
   }
   
   public function getFormName() {
      $len = strlen($this->_tableName);
      return ucfirst(substring($this->_tableName, 0, $len - 2));
   }
   
   public function getColumnName() {
      return $this->_columnName;
   }
   
   public function getDataType() {
      return $this->_dataType;
   }
   
   public function getDefault() {
      return $this->_default;
   }
   
   public function isNullable() {
      return true == $this->_nullable;
   }
   
   public function getLength() {
      return (int) $this->_length;
   }
   
   public function getPrecision() {
      return (int) $this->_precision;
   }
   
   public function isPrimary() {
      return true == $this->_primary;
   }
   
   public function getLabel() {
      return ucfirst( str_replace( '_', ' ', $this->_columnName ) );
   }
}
