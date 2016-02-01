<?php
class GenerateUrl{
	//Url attributes
   private $Url;
   private $Urlparams = array();
   private $Query_str;
   private $File;
   
   function __construct($url=""){
   	 $this->Url = $url;
   }
   private function addFile($filename=""){
   	  $this->File = $filename; 
   } 
   private function addUrlParams($param_name,$param_value){
  	$this->Urlparams[$param_name] = $param_value; 
  }
  private function createUrl(){
  	    $url = "";
	    $url .= ($this->File !='')?$this->Url.'/'.$this->File:$this->Url;
  	    $params = $this->Urlparams;
   	     if(count($params)>0){ $index = 0;
			foreach ($params as $param_key => $param_value) {    
				$url .= ($index === 0)?"?":"&";
				$url .= urlencode($param_key) ."=".urldecode($param_value);
				$index++;	 
			}		
   	   	} 
	return $url;
  }
  public static function buildLink($url,$addfile,$linktext,$param_list='',$extra_param=''){
	//creating links
  	$makeurl = new GenerateUrl($url);
     $makeurl->addFile($addfile);
	 if(strlen($param_list)!=0){
	 	$param_list = explode(",", $param_list);
		  //putting parameters together eg fname=ama
	 	foreach ($param_list as $params) {
			$params = preg_split("/=/", $params);
			$paramkey = $params[0]; $paramval = $params[1]; 
		    $makeurl->addUrlParams($paramkey, $paramval);
		 }
	 }
     $linktext = (strlen($linktext)==0)?$this->createUrl():trim($linktext);
  	return "<a href=\"".$makeurl->createUrl()."\" {$extra_param}>$linktext</a>";
  }
}
/*
 * Create a hyperlink 
*/
//$makeurl = GenerateUrl::buildLink("sirenghana.com","index.php","Go to sirenghana.com","page=123,action=view,target=news");





