<?php
class Thumbnail{
	private $img_xcoord;
	private $img_ycoord;
	private $size;
	private $width;
	private $height;
	private $thumb_width;
	private $thumb_height;
	
	function __construct(){
		$this->img_xcoord = 0;
		$this->img_ycoord = 0;
	}
	
  private function calThumbRatio(){
  	   $ratio = ($this->width/$this->height);
	   $thumbdim = ($this->thumb_width/$this->thumb_height);
	   if($ratio > $thumbdim){
	   	$this->thumb_width  = $this->thumb_width*$ratio;
	   }else{
	   	$this->thumb_height = $this->thumb_width/$ratio;
	   } 	
	   return; 
  }
  private function get_img_extension($string){
		$string = strtolower($string);
	 	 $dotpos = strrpos($string,".");
	  	 if(!$dotpos ){ return "";}
	    	$strlen = strlen($string) - $dotpos;
			$extension = substr($string,$dotpos+1,$strlen);
		 return $extension;
  }
  public function createThumbnail($source,$destination,$thumb_width=250,$thumb_height=200){
         $this->size = getimagesize($source);
		 $this->width  = $this->size[0];
		 $this->height = $this->size[1];
		 $this->thumb_width  = $thumb_width;
		 $this->thumb_height = $thumb_height;
  	     $this->calThumbRatio();
  	     $tempimage = imagecreatetruecolor($this->thumb_width,$this->thumb_height);
		 $ext = $this->get_img_extension($source);
			   if($ext=="jpg"||$ext=="jpeg"){
			     $image = imagecreatefromjpeg($source);
			   }
		   	   if($ext=="png"){
			  	 $image = imagecreatefrompng($source);
		       }
		   	   if($ext=="gif"){
			    $image = imagecreatefromgif($source);
			   }
		  //Outputing thumbnail images
		  imagecopyresampled($tempimage,$image,0,0,$this->img_xcoord,$this->img_ycoord,$this->thumb_width,$this->thumb_height,$this->width,$this->height);
		  if($ext =="jpg"||$ext=="jpeg"){
			  imagejpeg($tempimage,$destination,100);
		  }
		  if($ext =="png"){
			  imagepng($tempimage,$destination);
		  }
		  if($ext=="gif"){
			  imagegif($tempimage,$destination);
		  }
  }
}
$makethumb = new Thumbnail();
