<?php
class Job extends DatabaseObjects { 
 //job init function
 	public $Id;
	public $Company;
	public $Title;
	public $Empstatus;
	public $Category; 
	public $Description;
	public $Education;
	public $Experience;
	public $Location;
	public $Region;
	public $Contactaddr;
	public $Contactnum; 
	public $Email;
	public $Website; 
	public $Deadline; 
	public $Lastupdated;
	public $Listedby; 
	public $Position;
	protected static $tablename; 
 	function __construct($tablename=""){
		  return (!empty($tablename))?$this->getTablename($tablename):"";
	 }
	protected static function getTablename($tablename=""){
	   static::$tablename = ($tablename)?$tablename:"";
	 }
	public function jobCategory($tablename){
		 $jobcat =(!empty($tablename))?$this->getTablename($tablename):"";
		 return $jobcat;
	}
}
//This inta
$job = new Job("Jobs");
$jobcat = $job->jobCategory("Jobcategory");
 