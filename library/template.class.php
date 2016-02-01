<?php
class Template{
    public $HTML = array();
    public $filename_arr = array();
    function __construct(){
        $this->HTML = array(
            "Header" =>"", "Meta"=>"",
            "Stylesheet"=>"","Script"=>"",
            "Title"=>"","Banner"=>"",
            "MainNav"=>"", "PageHeader" =>"","AsideLeft"=>"",
            "AsideRight"=>"","Content"=>"","Footer"=>"");
        
    } 
    public function addElement($element,$location="Content"){
		$this->HTML[$location] .= $element;
                
    }
    public function setPage($key,$value){
        if(array_key_exists($key, $this->HTML)){$this->HTML[$key]  = $value;}
        }
   public function getPage($indexkey){
       return array_key_exists($indexkey, $this->HTML)?$this->HTML[$indexkey]:null;
       
   }
   /**/
    public function loadPage(array$pages,$filepath="",$ext="php"){
            $get_target = $GLOBALS["target"]; $output ="";
            $this->filename_arr = array_merge($this->filename_arr,$pages);
            $get_target = str_ireplace(" ","_",strtolower($get_target));
              if(in_array($get_target,$this->filename_arr)){
                 $filename = $filepath.$get_target.".".$ext;
                  if(file_exists($filename)){
                  	include_once $filename;
                  }else{
                  	include_once PUBLIC_DIR."404.php";//page is not found error
                  }
                   
              }    
            }
    public function load_Template_Layout($filepath){
   	     include_once $filepath;
    }
}
$template = new Template();


