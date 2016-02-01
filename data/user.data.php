<?php
//User Data Class
class User extends SchemaObjects{
	 public $Id;
	 public $Firstname;
	 public $Lastname;
	 public $Gender;
	 public $Username;
	 public $Email;
	 public $Password;
	 public $Authlevel;
	 public $Lastupdated;
	 protected static $tablename="Users";
 
     public function fullName(){
	 	if(isset($this->Firstname) && isset($this->Lastname)){
	 		return $this->Firstname." ".$this->Lastname;
	 	}else{ return "";}	
	 }
     public function userName(){
	 	if(isset($this->Username)){
	 		return $this->Username;
	 	}else{ return "";}	
	 }
     public static function authenticate($username,$password){
	  		global $database;
			$username = $database->escapeString($username);
			$password = $database->escapeString($password);
             $sql = "SELECT Id FROM ".static::$tablename." 
             ".static::where("
               Username ='{$username}' AND Password ='{$password}'
               OR Email ='{$username}' AND Password ='{$password}'
             ")." LIMIT 1";
	 $foundrow = static::findBySql($sql);
	 return (!empty($foundrow))? array_shift($foundrow):false;
	  }

  public static function userExists($username=''){
  	       return self::fieldExists($username);//$username = value eg. Username =Rahman
  }
}
$users = new User("Users");
