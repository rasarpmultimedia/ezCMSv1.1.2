<?php
class Navigation extends SchemaObjects{
	  //Navigation attributes
	  public $Id;	
	  public $Nav_name;
	  public $Nav_type;
	  public $Nav_level;
	  public $Position;
	  public $Visible;
	  public $Featured;
	  //Sub navigation attributes
	  public $Nav_id;	
	  public $Sub_navname;
	  public $Sub_navtype;
	  public $Subnav_level;
	  protected static $tablename;
	  function __construct($tablename=""){
		return (!empty($tablename))?$this->getTablename($tablename):"";
	 }
	 protected static function getTablename($tablename=""){
	   static::$tablename = ($tablename)?$tablename:"";
	 }
	 public static function selectNavTable($tablename){
	 	    return new Navigation($tablename);
	 }
        
	  
}

$navigation = new Navigation();