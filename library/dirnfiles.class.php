<?php
//This class has file system management utilities
class DirectoriesNFiles{
	//Directories
	public $Dirfilepath;
	//files
    public $Filename;
	public $Data; 
	public $Fileoutputarr = array();
	
	
	public function Directory($dirfilepath){
		$this->Dirfilepath = $dirfilepath;
		$dirhandle = opendir($this->Dirfilepath);
		while(false !== ($filename = readdir($this->Dirfilepath))){
			$this->Fileoutputarr[] = $filename;
		}
		 return $this->Fileoutputarr;
	}
	
	public function getFileparts(array$filearray,$filepart=array("filename","extention")){
		foreach ($filearray as $file) {
			$fileparts = preg_split("/\./", $file);
		}
		return $filepart[0]?$fileparts[0]:$fileparts[1];
	}
	
    public function writeInFile($filename="", $data=""){
    	  $this->Filename = $filename;
		  $this->Data = $data;
		  if(file_exists($this->Filename)){
   	      	 $handle = file_put_contents($this->Filename, $this->Data);
			 return $handle;
   		  }else{
   		  	exit("***File Error: File ".$this->Filename." do not exist.***");
   		  }
   }
	
   public function readFromFile($filename=""){
    	  $this->Filename = $filename;
		  if(file_exists($this->Filename)){
   	      	 $fread = file_get_contents($filename);
			 return $fread;
   		  }else{
   		  	exit("***File Error: File ".$this->Filename." do not exist.***");
   		  }   
    }
 
    public function readFileInArr($filename=""){
    	 $this->Filename = $filename;
		  if(file_exists($this->Filename)){
		  	  $file = file($this->Filename);
			  foreach($file as $output_file){
			  	$this->Fileoutputarr[] = $output_file;
			  }
			  return $this->Fileoutputarr;
		  }
    }

}
 $makedirnfiles = new DirectoriesNFiles(); 
 