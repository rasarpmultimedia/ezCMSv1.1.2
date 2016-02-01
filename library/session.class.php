<?php
class Session{
	public $userid;
	private $logged_in = false;
	private $authlevel;
	private $user;
	
	function __construct(){
		session_start();
		//$this->user = new User;
		$this->checkLogin();	
	}

   private function checkLogin(){
  	     if(isset($_SESSION["id"])){
  	     	$this->userid = $_SESSION["id"];
			$this->logged_in = true;
  	     }else{
  	     	unset($this->userid);
			unset($this->authlevel);
			$this->logged_in = false;
  	     }   
  }
  public function isLoggedIn(){
  		return $this->logged_in;
  }
  public function isAdmin(){ global $users;
  	     if($this->isLoggedIn())	{
			$user = $users::findRow("Id={$this->userid}");
			return (strcasecmp(ADMIN,$user->Authlevel)==0)?true:false;
		}	
  	     
  }
  public function isEditor(){ global $users;
  	      if($this->isLoggedIn())	{
			$user = $users::findRow("Id={$this->userid}");
			return (strcasecmp(EDITOR,$user->Authlevel)==0)?true:false;
		}  
  }

  public function LogIn($user){
   	   	 if($user){
   	   		 $this->userid    = $_SESSION["id"] = $user->Id;
			 $this->authlevel = $_SESSION["authlevel"] = $user->Authlevel;
   	   	 }
		 $this->logged_in = true;
   }
  public function logOut(){
  	 unset($_SESSION["id"]);
	 unset($_SESSION["authlevel"]);	
  	 unset($this->userid);
	 $this->logged_in = false;
	 return $this->logged_in;
  }
}
$session = new Session();