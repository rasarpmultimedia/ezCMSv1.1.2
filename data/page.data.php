<?php
/*
 * include_once"includes/initialize.inc.php";
*/ 
class Page extends SchemaObjects {
   //Page attributes
    public $Id;
	public $Title;
	public $Content;
	public $Source;
	public $Postedby;
	public $Dateposted;
	public $Position;
	public $Published;
	public $Featured;
	public $Views; 
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

