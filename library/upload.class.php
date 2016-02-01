<?php
class UploadFiles{
  public  $Upload_dir;
  private $Temp_dir;
  public  $Thumb_dir;
  public  $Upload_err = array();
  public  $Upload_status = false;
  //public  $upload_time = time;
  //upload file attributes
  public $Filename;
  public $Newfilename;
  public $File_ext;
  public $Filetype;
  protected $Files;
  protected $Filetemp_name;
  public $Filesize;
  public $Mimetype;
  public $File_error;
  
  //set upload flags;
   const MAX_IMG_WIDTH 	  	= 300;
   const MAX_IMG_HEIGHT   	= 250;
   const MAX_THUMB_WIDTH  	= 100;
   const MAX_THUMB_HEIGHT 	= 90;
   const SET_MAX_FILE_SIZE 	= 30000000;
   
  //private $Imgtype;//images mime types to accept 
  /** @access set database attributes  */
  public  $Width;
  public  $Height;
   
  function __construct($upload_dir="",$temp_dir=""){
  	$this->Upload_dir = $upload_dir;
	$this->Thumb_dir = $this->Upload_dir."thumbnails/";
	$this->Temp_dir = strlen($temp_dir)!=null?$temp_dir:"";
	$this->Files = $_FILES;
  }
  /** @method uploadFile,
   * Prepare file for uploads 
   * */
  public function uploadFile($fieldname){
    //$upload_time = time();
  	foreach($this->Files[$fieldname]["error"] as $key => $error){
  		$this->Filename = basename($this->Files[$fieldname]["name"][$key]);
		$this->Filename = str_replace(" ", "_", $this->Filename);
		//$this->Filename = $upload_time."_".$this->Filename;
                $this->Filetype = $this->Files[$fieldname]["type"][$key];
                $this->Filetemp_name = $this->Files[$fieldname]["tmp_name"][$key];
                $this->Filesize = $this->Files[$fieldname]["size"][$key];	
		//upload sucess
	    if($error == UPLOAD_ERR_OK){
	     $this->processImgUpload();
		 return $this->Upload_status = true;
	    }else{return $this->Upload_status = false;}//upload failure
	}  
  }
  protected function processImgUpload(){
	 //if no errors are found  
  	 $thumbnail = new Thumbnail();
	       if(is_uploaded_file($this->Filetemp_name)){
	   	      //$this->Filename = rename($this->Filename,$upload_time."_".$this->Filename);
			  $tmploc  =  move_uploaded_file($this->Filetemp_name,$this->Temp_dir.$this->Filename); 
			   if($tmploc){ 
				$thumbnail->createThumbnail($this->Temp_dir.$this->Filename,$this->Thumb_dir.$this->Filename,
				self::MAX_THUMB_WIDTH,self::MAX_THUMB_HEIGHT);
				$thumbnail->createThumbnail($this->Temp_dir.$this->Filename,$this->Upload_dir.$this->Filename,
				self::MAX_IMG_WIDTH,self::MAX_IMG_HEIGHT);
			    list($new_width,$new_height) = getimagesize($this->Upload_dir.$this->Filename);
			    $this->Newfilename = $this->getFilename($this->Filename,".");
			    $this->File_ext    = $this->get_file_extension($this->Filename);
				$this->Filesize = $this->Filesize;	
				$this->Width    = $new_width; 
				$this->Height   = $new_height; 
                $this->Filetype; 
			   }
		       $this->deleteFile($this->Temp_dir.$this->Filename);
		   }
	   }

   public function deleteFile($filepath){
	 unlink($filepath);
   }
   protected function get_file_extension($string){
		$string = strtolower($string);
	 	 $dotpos = strrpos($string,".");
	  	 if(!$dotpos) return "";
	    	$strlen = strlen($string) - $dotpos;
			$extension = substr($string,$dotpos+1,$strlen);
		 return $extension;
	}
   
	protected function getFilename($string,$seperator){
	 	$string = strtolower($string);
    	list($name) = explode("$seperator", $string);
    	return $name;
	}
}

$upload = new UploadFiles();
