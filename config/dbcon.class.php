<?php
//require_once"dbconstants.php";
class MySQLDatabase{
	private $connection;
	private $last_query;
	private $magic_quotes_active;
	private $query_result;
	private static $dbinstance = 0;
 	       function __construct(){
		   $this->magic_quotes_active = function_exists("get_magic_quotes_gpc");
		    $mysqlconnect = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		    static::$dbinstance = 1;
			if($mysqlconnect->errno){
	 			echo "Cannot connect to SQL SERVER: ".$mysqlconnect->error;
			}
			$this->connection = $mysqlconnect; return static::$dbinstance;
 		}
		
		public function closeConnection(){
			 if($this->connection){
			 	 return $this->connection->close();
				 static::$dbinstance = 0;
			 }
		}
	/* This Function is for General Perpose query to databases */
		public function query($query=null){
			    $this->last_query = $query;
		 		$this->query_result = $this->connection->query($query);
		 		$this->confirmQuery($this->query_result);
				return $this->query_result!=null?$this->query_result:"";			 
		}
		public function fetchAssoc(){
			return $this->query_result->fetch_assoc(); 
		}
		public function fetchObj($classname=''){
		       return $this->query_result->fetch_object($classname);
		}
		public function getNumofRows(){
		       return $this->query_result->num_rows;
		}
		public function getInsertedId(){
                    return $this->connection->insert_id;
		}
		public function affectedRows(){
                    return $this->connection->affected_rows;
		}
		private function confirmQuery($results){
                if(!$results){
	      	   $output = "Can not query form database: ".$this->connection->error;
			   $output .= "<br />Last SQL Query: ".$this->last_query;
			   echo $output;
		       exit();
		  }
		}
	
        public function escapeString($dbstr){
	       if($dbstr){ $dbstr = trim($dbstr);
			    if(!$this->magic_quotes_active){
				 $dbstr = $this->query_result->real_escape_string($dbstr);
			    }else{ $dbstr = addslashes($dbstr); }
                }
	        return $dbstr;
	        }

}
$database = new MySQLDatabase();
$db =& $database;