<?php
class BusinessDirectory extends SchemaObjects{
	public $Id;  
 	public $Company;
 	public $Category;//combo box 
	public $Address;
	public $Website;
	public $Location; 
	public $Region; // combo box
	public $Phone; 
	public $Fax; //optional field
	public $Description ;
	public $Lastupdated;//auto date 
	public $Position;//hidden field 
    //page init function 
    protected static $tablename;
	function __construct($tablename=""){
		 return (!empty($tablename))?$this->getTablename($tablename):"";
	 }
	 protected static function getTablename($tablename=""){
	   static::$tablename = ($tablename)?$tablename:"";
	 } 
	public function getPageData($tablename){
		 return (!empty($tablename))?$this->getTablename($tablename):"";	
	}
}