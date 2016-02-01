<?php
class GlobalSettings extends SchemaObjects{
	//Settings attributes
	public $Position;
	public $Published;
	public $Featured;
  //Pagination attributes 
    public $Action;
    public $Currentpage;
    public $Contentpos;
    public $Target;
    public $Perpage   = 1;//page by page
    public $Pagelimit = 5;//group selection limit in one page
    protected static $tablename;
    //page init function 
    function __construct($tablename=""){
            $this->Action      = isset($_REQUEST["action"])?strval($_REQUEST["action"]):"";
            $this->Target      = isset($_REQUEST["target"])?strval($_REQUEST["target"]):"";
            $this->Currentpage = isset($_REQUEST["page"])?intval($_REQUEST["page"]):intval(1);
            $this->Contentpos  = isset($_REQUEST["cpos"])?intval($_REQUEST["cpos"]):intval(1);
            return (!empty($tablename))?$this->getTablename($tablename):"";
            }
            protected static function getTablename($tablename=""){
                static::$tablename = ($tablename)?$tablename:"";
            }
	
}
class GetTableRecord extends SchemaObjects{
 protected static $tablename;
function __construct($tablename=""){
		  (!empty($tablename))?$this->getTablename($tablename):"";
	 }
protected static function getTablename($tablename=""){
	   static::$tablename = ($tablename)?$tablename:"";
	 } 
	public function getData($tablename){
		 (!empty($tablename))?$this->getTablename($tablename):"";	
	}	
}

