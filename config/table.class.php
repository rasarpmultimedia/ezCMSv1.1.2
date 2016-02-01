<?php
class Table extends SchemaObjects { 
    protected static $tablename;
	function __construct($tablename=""){
	  return (!empty($tablename))?$this->getTablename($tablename):"";	  
	 } 
	protected static function getTablename($tablename=""){
	  static::$tablename = ($tablename)?$tablename:"";
	 }
	public function getTableData($tablename){
		 return (!empty($tablename))?$this->getTablename($tablename):"";	
	}
}
?>