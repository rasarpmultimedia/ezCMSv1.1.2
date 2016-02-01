<?php
//Template Data Class
class TemplateData extends DatabaseObjects{
 public $Id; 
 public $Template_name;
 public $Status;
 public $Base_url;
 protected static $tablename;
   function __construct($tablename=""){
		return (!empty($tablename))?$this->getTablename($tablename):"";	 
	 }
    
	 protected static function getTablename($tablename=""){
	   static::$tablename = ($tablename)?$tablename:"";
	 }
}
$page_template = new TemplateData("Template");

class Website extends DatabaseObjects{
 public $Id; 
 public $Site_name;
 public $Site_template;
 public $Site_status;
 public $Site_url;
 protected static $tablename;
  function __construct($tablename=""){
		return (!empty($tablename))?$this->getTablename($tablename):"";	 
	 }
 
	 protected static function getTablename($tablename=""){
	   static::$tablename = ($tablename)?$tablename:"";
	 }
}
$siteinfo = new Website("Sites");


