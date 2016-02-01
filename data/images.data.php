<?php
class Image extends SchemaObjects{
	  protected static $tablename;
	  function __construct($tablename=""){
		  return (!empty($tablename))?$this->getTablename($tablename):"";
	  }
	protected static function getTablename($tablename=""){
	   static::$tablename = ($tablename)?$tablename:"";
	 }
	public function showThumbImage($getimgid=1,$thumbdir=''){
	         $page_image = static::findRow("Pageid={$getimgid}");	 
		 if($page_image) { 
	         $thumbimg  = $thumbdir.$page_image->Imgname.".".$page_image->Extention;
	         return (strlen($page_image->Imgname)!=0)?"<img src=\"$thumbimg\" alt=\"".$page_image->Imgname."\" title=\"".$page_image->Imgcaption."\"  class=\"thumbimg\" />":"";
			 }else{ return "";}
	   }
	 
	public function showFullImage($getimgid=1,$imgdir=''){
	        $page_image = static::findRow("Pageid={$getimgid}");	
		if($page_image) {
		 $imgdir  = $imgdir.$page_image->Imgname.".".$page_image->Extention;
	         $display_img = (strlen($page_image->Imgname)!=0)?
                         "<img src=\"$imgdir\" alt=\"".$page_image->Imgname."\" title=\"".$page_image->Imgcaption."\" width=\"".$page_image->Width."\" height=\"".$page_image->Height."\" class=\"pageimg\" />":"";	
			 $display_img .= (strlen($page_image->Imgname)!=0 && $page_image->Imgcaption !=null)?"<p class=\"imgcap\">".$page_image->Imgcaption."</p>":"";
			 return $display_img;
			 }else{return ""; }       
	}
}
//$image = new Image();