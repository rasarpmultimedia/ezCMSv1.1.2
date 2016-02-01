<?php
class SchemaObjects{
    //common database methods
	 public static $tablefields = array();
	 public static $id = null;
	 // MySQL where clause
	protected static function where($clause){
     	return " WHERE {$clause} ";
     }
	/**This function set table array in a table
	 * @method setTableFields,
	 * @param  $fieldname, e.g default value is null. usage "Id"
	 * @param  $value , e.g default value is null.  usage "1"
	 * */
	public static function lastInsertedId(){
		global $database;
		return $database->getInsertedId();
	}
	/**This function count rows in a table
	 * @method countRows,
	 * @param  $whichfield = null, e.g default value is null. usage "Id=1"
	 * */
	public static function countRows($whichfield=null){
	 	$query = "SELECT COUNT(*) as Totalrows FROM ".static::$tablename;
		$query .=" ".($whichfield!=null?static::where($whichfield):"");
		$result_set = static::findBySql($query);
		return (!empty($result_set))? array_shift($result_set):false; 
	}
	
	/**This function count rows by field name or items in a table
	 * @method countRowsByField,
	 * @param  $field , e.g default value is null. usage "Fisrtname='Rahman'" 
	 * @param  $whichfield = null, e.g default value is null. usage "Id=1"
	 * @return $result_set (array)
	 * */
	public static function countRowsByField($field,$whichfield=null){
		$query = "SELECT {$field}, COUNT(*) as Totalcounts FROM ".static::$tablename;
		$query .=" ".($whichfield!=null?static::where($whichfield):"");
		$result_set = static::findBySql($query);
		return $result_set;
	}
	
	/** loops thru table to fetch all records into a data array
	 * @method findAllRecords,
	 * @param  $addclause ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
	 * @return $data arraywith ojbects values : use foreach to go thru array
	 *  */
	public static function findAllRecords($addclause=''){
		$data = static::findBySql("SELECT * FROM ".static::$tablename." $addclause");
		return $data;
	 }
	
	/**loops thru table to fetch specific find into a data array
	 * @method findRecords,
	 * @param  $whichfield = null, e.g default value is null. usage "Id=1"
	 * @param  $addclause ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
	 * @return $data array with ojbects values : use foreach to go thru array
	 *  */
	public static function findRecords($whichfield=null,$addclause=''){
	 	$data = static::findBySql("SELECT * FROM ".static::$tablename.
	 	" ".($whichfield!=null?static::where($whichfield)." $addclause":"$addclause"));
		return $data;
	 }
	
	/**This functions are used to Search Data in the database using the like a% in $matchPatern
    * @method searchAllData,
    * @param  $whichfield = null, e.g default value is null. usage "Id=1"
	* @param  $match_pattern="" e.g default value is empty. usage "regex to /\bw+\b/"
    * @param  $offset=1 e.g default value is 1. usage sql offset value from pagination func "5"
    * @param  $limit ='' e.g default value is 10. usage . use it to set sql limits
	* @return $result_set array : use foreach to go thru array
	* how the fn is used: $page->searchAllData("Title","Like a% ","2","5");
    * */
	  public static function searchAllData($whichfield=null,$match_pattern="",$limit=10,$offset=1){
	 	$query = "SELECT * ";
	 	$query .=" FROM ".static::$tablename."";
	 	$query .=" ".($whichfield!=null?static::where($whichfield." ".$match_pattern):"");//more
	 	$query .=" LIMIT $limit ";
		$query .=" OFFSET $offset";
		$result_set = static::findBySql($query);
		return $result_set; 
	 }
	/**perform sql database search specific fieldnames
    * @method searchDataByFieldNames,
    * @param  array$setfields usage e.g. array('Fieldname1','Fieldname1','...')
    * @param  $whichfield = null, e.g default value is null. usage "Id=1"
	* @param  $match_pattern="" e.g default value is empty. usage "regex to /\bw+\b/"
    * @param  $offset=1 e.g default value is 1. usage sql offset value from pagination func "5"
    * @param  $limit ='' e.g default value is 10. usage . use it to set sql limits
	* @return $result_set array : use foreach to go thru array
    * */
	public static function searchDataByFieldNames(array$setfields,$whichfield=null,$match_pattern="",$limit=10,$offset=1){
	      $query = "SELECT "; 
	      $query .= (count($setfields)>=1)?implode(",",$setfields):"*";
	      $query .=" FROM ".static::$tablename;
	      $query .=" ".($whichfield!=null?static::where($whichfield." ".$match_pattern):"");
	      $query .="LIMIT $limit ";
	      $query .=" OFFSET $offset";
		 $result_set = static::findBySql($query);
		 return $result_set; 
	} 
	
  /** this function fetches page contents form database
    * @method getPageDesc,    
    * @param  $pagepos=1 usage  e.g default value is null. usage current page for querystring page="1"
    * @param  $pagelimit=5, e.g default value is 5. usage sql limit  "10"
    * @param  $pageoffset=1 e.g default value is 1. usage sql offset value from pagination func "5"
    * @param  $order ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
    * @return $result_set array : use foreach to go thru array
    * */ 
	public static function getPageDesc($pagepos=1,$pagelimit=5,$pageoffset=1,$order=''){
	 	$query = "SELECT *";
	 	$query .=" FROM ".static::$tablename."";
	 	$query .=static::where("Position={$pagepos}"); 
	 	$query .=" $order LIMIT ".$pagelimit;
		$query .=" OFFSET $pageoffset";
		$result_set = static::findBySql($query);
		return $result_set; 
	 }
	
  /** this method fetches page contents form database
    * @method findPage, 
    * @param  $perpage=5, e.g default value is 5. usage sql limit  "10"
    * @param  $pageoffset=1 e.g default value is 1. usage sql offset value from pagination func "5"
    * @param  $order ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
    * @return $result_set array : use foreach to go thru array
	* */
	public  static function findPage($perpage=1,$pageoffset=1,$addclause='',$order=''){   
		    $query = "SELECT * ";
			$query .=" FROM ".static::$tablename."";
			$query .=($addclause!=null?static::where($addclause):"");
			$query .=" $order LIMIT $perpage ";
			$query .=" OFFSET $pageoffset";
			$result_set = static::findBySql($query);
			return $result_set;
	 }  

   /**finds finds specified in an array
    * @method findSelectedFields,
    * @param  array$setfields usage e.g. array('Fieldname1','Fieldname1')
    * @param  $whichfield = null, e.g default value is null. usage "Id=1"
    * @param  $order ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
    * @param  $limit ='' e.g default value is empty. usage "5"
    * @return $result_set array : use foreach to go thru array
    * */
	public static function specificFields(array $setfields,$whichfield = null,$order='',$limit=1){
        //$setfields = array();
	  $query = "SELECT "; 
	  $query .= (count($setfields)>=1)?implode(",",$setfields):"*";
	  $query .=" FROM ".static::$tablename;
	  $query .=" ".($whichfield!=null?static::where($whichfield):"");
	  $query .=" $order LIMIT $limit";
	  $result_set = static::findBySql($query);
       return $result_set ;
	}
	
	/**find and instantiate rows into objects
	 * @method findRow,
	 * @param  $whichfield = null, e.g default value is null. usage "Id=1"
	 * @return $result_set stdClass array
	 * */
    public static function findRow($whichfield=null){
	 	$foundrow = static::findBySql("SELECT * FROM ".static::$tablename.""
	 	.($whichfield!=null?static::where($whichfield):""));
		return (!empty($foundrow))?array_shift($foundrow):false;
	 }
	 
	/**find and instantiate rows into objects
	 * @method category,
	 * @param  $addclause ='' e.g default value is empty. usage "ORDER BY Id ASC|DESC"
	 * @return $data arraywith ojbects values : use foreach to go thru array*/
    public static function category($tblname,$addclause){
	 	$query = " SELECT * FROM $tblname";
 		$query .= static::where($addclause)."LIMIT 1";
		$foundpage = static::findBySql($query);
		return (!empty($foundpage))? array_shift($foundpage):false; 
	 } 
	 /**finds and checks specified field and instantiate row into object array
	 * @method fieldExists,
	 * @param  $field , e.g default value is null. usage "Fisrtname=Rahman"
	 * @return $foundfield stdClass array
	 * */
	public static function fieldExists($tblfield){
  	      global $database; 
  	      $split_var = preg_split("/=/", $tblfield);
		  $fieldname  = $split_var[0]; $fieldvalue = $database->escapeString($split_var[1]);
  	  	  $sql ="SELECT $fieldname FROM ".static::$tablename;
		  $sql .= static::where("$fieldname = '{$fieldvalue}'")." LIMIT 1";
	  	  $foundfield = static::findBySql($sql);
	  	  return (!empty($foundfield))? array_shift($foundfield):false;
     } 
	 /**sql statement phaser method;
	 * @method findBySql,
	 * @param  $sql ='' , e.g default value is empty. usage "recieves SQL Statement"
	 * */
	 protected static function findBySql($sql=''){
	 	    global $database;
			if($database->query($sql)){
			return ($database->getNumofRows()!=0)? static::instantiate():"";
			}
			$database->closeConnection();		 
	 }
	 /** sql statement phaser method this initialize rows into objects arrays
          * @method instantiate,
	 * */
 	 private static function instantiate(){
 	 	     global $database; $objects = array();
		     $classname = get_called_class();
	         while($row = $database->fetchObj("$classname")){
			    $objects[] = $row;
	     	 }
	   return $objects;
	}
	 /**sql statement phaser method usage:insert data into tables;
	 * @method insertData, 
	 * */
	private function insertData(){
		global $database;
		$query = "INSERT INTO ".static::$tablename;
		$query .= "(";
		$query .= implode(", ",array_keys(static::$tablefields));
		$query .= ") VALUES ( '";
		  foreach (array_values(static::$tablefields) as $value) {
	     	 $fieldvalues[] = $database->escapeString($value);
		  }
		$query .= implode("','",$fieldvalues);
		$query .= "' )";
          $database->query($query);
	     $database->getInsertedId();
	}
    /**sql statement phaser method, update data in tables;
	 * @method updateData, 
	 * */
   private function updateData(){
   	global $database;
		 $query = "UPDATE ".static::$tablename; 
		 $query .= " SET ";
		 	foreach (static::$tablefields as $fieldname => $fieldvalue) {
		 	 $setfields[] = " {$fieldname} = '".$database->escapeString("{$fieldvalue}")."'";
		 	}
		 $query .= implode(", ",$setfields);
		 $query .= static::where(static::$id)." LIMIT 1";
      $database->query($query);
	  $database->getInsertedId();
   }
   /**sql statement phaser method usage: replaces data in tables;
    * @method replaceData,
    * */
   public static function replaceData(){
   		global $database;
		$query = "REPLACE INTO ".static::$tablename;
		$query .= "(";
		$query .= implode(", ",array_keys(static::$tablefields));
		$query .= ") VALUES ( '";
		  foreach (array_values(static::$tablefields) as $value) {
	     	 $fieldvalues[] = $database->escapeString($value);
		  }
		$query .= implode("','",$fieldvalues);
		$query .= "' )";
      $database->query($query);
      $database->insertedId();
   }
    /**sql statement phaser methodthis deletes row in a table;
    * @method delete, 
	 * */
   public function delete(){
 	 global $database;
 	 $query = "DELETE FROM ".static::$tablename." ".static::where(static::$id);
	 $query .= " LIMIT 1";
	 $database->query($query);
  }
 /**it saves data into database,
  * @method save,
 * */
  public function save(){
    return isset(static::$id) == null ?$this->insertData():$this->updateData();
  }
}