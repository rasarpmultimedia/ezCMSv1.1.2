<?php
/*
 * Class Create Html Form */
class Form{
	 private $htmlForm;
	 //form attributes
	 public  $formName ='';
	 private $action;
	 private $method;
	 protected $inputName;
	 protected $inputType;
	 private   $extra_attr;
	 
	 private $formInputs = array(); 
	 private $groupFormInputs = array();
	 public  $selOptions = array();
	 
	 function __construct($name,$action="",$method="get",$extra_attr=""){
		$this->formName = $name;
		$this->action   =  $action;
		$this->method   = $method;
		$this->extra_attr  = $extra_attr;
		
	 }
	 public function startForm(){
	 	$this->htmlForm = "<form action=\"{$this->action}\" name=\"{$this->formName}\" id=\"{$this->formName}\" method =\"{$this->method}\" {$this->extra_attr} > \n";
		return $this->htmlForm;
	 }
	 public function inputLabel($for,$name){
	   return"<label for =\"$for\">$name:</label>";
	 }
	 public function addFormInfo($element){
	 	return $element;
	 }
         public  function inputField($type,$name,$value='',$optional_attr=''){
    	 return"<input type=\"{$type}\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" $optional_attr />\n";
                }
         public  function uploadField($name,$id="",$optional_attr=''){
    	 return"<input type=\"file\" name=\"{$name}\" id=\"{$id}\"  $optional_attr />\n";
                }
         public function textAreaField($name,$value='',$rows='',$cols='',$optional_attr=''){
		$extra_arr = (strlen($rows)>0||strlen($cols)>0)?"rows =\"$rows\" cols=\"$cols\"":"";
		return "<textarea name=\"$name\" id=\"$name\" $extra_arr $optional_attr>$value</textarea>\n";
	 }
	/*Select Options*/
         public function selectOptions($name,array$options,$postback_field){ 
            $output = "<select name=\"{$name}\" id=\"{$name}\">  \n";
            foreach($options as $key=>$option){
                $output .= ($key == $postback_field)?"<option value=\"{$key}\" selected =\"selected\">{$option}</option>":"<option value=\"{$key}\" >{$option}</option> \n";                     
                }      
                $output .="</select>"; return $output;
	 }

	 public function dataList($id,array$options){ 
	    $output = "<datalist id=\"{$name}\">  \n";
	 	foreach($options as $option){
	 	$output .= "<option label=\"{$option}\" value=\"{$option}\" />";
		}
	    $output .="</datalist>"; return $output;
	 }
	 public function radioButton($label,$name,$value='',$checked=true){
	 	$checked = ($checked==true)?"checked=\"checked\"":"";
	 	return "<span><label><input type=\"radio\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" $checked />".ucfirst("{$label}")."</label></span>";
	 }
	 public function checkBox($lable,$name,$value='',$checked=false){
	   $checked = ($checked==true)?"checked=\"checked\"":"";
	   return "<span><label><input type=\"checkbox\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" $checked />".ucfirst("{$label}")."</label></span>";
	 }
	 public function setFormField($label='',$field='',$error=''){
	 	if($label<>null){
	 	$this->formInputs[$label] = (strlen($error)>0)?array($field,$error):array($field);
		}else{
		$this->formInputs[] = array($field);	
		}
		return $this->formInputs;
	 }
	 public function groupFormFields($header,$label,$field,$error){
	 	 return array_merge($this->groupFormInputs,array($header=>$this->setFormField($label,$field,$error))); 
	 }
	 public function endForm(){
	 	return $this->htmlForm = "\n</form> ";
	 }
	 //end of form elements
	 
	 public function DisplayFields($layout,$message=""){
	 	    $message = strlen($message)>0?$message:$message; 
	 	    switch($layout){
			 case"Left Labling":
				$output ="<div id=\"formWrapper\">";
				  $output .= $message; 
				 $output .=$this->startForm();
				 foreach($this->formInputs as $label =>$data){
				 	  $input = isset($data[0])?$data[0]:$data[0]; 
				 	  $error = isset($data[1])?$data[1]:$data[1];
				 $output .= $message;  
				 $output .="<div class=\"input-data\">{$label}{$input} \n";
				 $output .=(strlen($error)>0)?"<p class=\"error\">{$error}</p> </div>\n":"</div>";	 
				 }
				 $output .=$this->endForm()."</div>\n";
				  return $output;
			 break;
			 case"Top Labling":
				 /*display form */
				 $output ="<div id=\"formWrapper\">";
				 $output .= $message;  
				 $output .= "<ol class=\"appform\">";
				 $output .= $this->startForm();
				 foreach($this->formInputs as $label =>$data){
				 	  $input = isset($data[0])?$data[0]:$data[0]; 
				 	  $error = isset($data[1])?$data[1]:""; 
				 $output .=(strlen($label)<=1)?"<li><div>{$input} \n":"<li><div>{$label}<br/>{$input} \n";
				 $output .=(strlen($error)>0)?"\n <p class=\"error\">{$error}</p></div></li> ":"</div></li> \n";	 
				 }
				 $output .=$this->endForm()."</ol>";
				 $output .="</div>";
				 return $output;
			break;
			case"Upload Labling":
				  //puts 
				$output ="<div id=\"uploadWrapper\">";
				  $output .=$this->startForm();
				 foreach($this->formInputs as $label =>$data){
				 	  $input = isset($data[0])?$data[0]:$data[0]; 
				 	  $error = isset($data[1])?$data[1]:$data[1];
				 $output .= $message;  
				 $output .="<div class=\"input-data\">{$label}{$input} \n";
				 $output .=(strlen($error)>0)?"<p class=\"error\">{$error}</p> </div>\n":"</div>";	 
				 }
				 $output .=$this->endForm()."</div>";
				  return $output;
			break;
			case 'Login Labling':
				 /*display form */
				 $output ="<div id=\"loginWrapper\">";
				 $output .= $message;  
				 $output .= "<ul class=\"-form\">";
				 $output .= $this->startForm();
				 foreach($this->formInputs as $label =>$data){
				 	  $input = isset($data[0])?$data[0]:$data[0];  
				 $output .=(strlen($label)<=1)?"<li>{$input} \n":"<li>{$label}<br/>{$input} \n";	 
				 }
				 $output .=$this->endForm()."</ul>";
				 $output .="</div>";
				 return $output;
				break;
			default:
	 	    }
	 }
}

/**
 *Class Validate forms 
 */
class FormValidator{
 private $field_errors= array();
 public  $upload_fieldname;
//Checks for required empty fields
 public function check_requiredFields($required_array){
 	     foreach ($required_array as $fieldname) {
		    if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
	  	    $this->field_errors[$fieldname] = "* {$fieldname} is required";
	  	  }
	   }
	 return $this->field_errors;
 }
 //Checks for bad characters if field names
 public function check_invalidChars($required_array){
 	     foreach ($required_array as $fieldname) {
		  if(!empty($_POST[$fieldname]) && !preg_match("/^[a-zA-Z]/",$_POST[$fieldname])){
	  	    $this->field_errors[$fieldname] = "* {$fieldname} is not allowed";
	  	  }
	   }
	 return $this->field_errors;	
 }
 //Checks for required fields length //key =>value pair
   public function check_FieldLength($required_len_array){
 	   foreach($required_len_array as $fieldname => $maxlen){
	  	  if(!empty($_POST[$fieldname]) && strlen(trim($_POST[$fieldname],"\r\n")) < 3){
	  	  $this->field_errors[$fieldname] = "* {$fieldname} is too short";
	  	  }
	  	  if(!empty($_POST[$fieldname]) && strlen(trim($_POST[$fieldname],"\r\n")) > $maxlen){
	  	  $this->field_errors[$fieldname] = "* {$fieldname} is too long";
	  	}
	  }
	 return $this->field_errors;
  }
  //Check for Select Option is null;
  public function check_selectField($option_array){
  	 foreach($option_array as $option =>$selval){
  	 	 if($_POST[$option] == $selval){
  	 	 	$this->field_errors[$option] = "* {$option} is required";
  	 	 }
  	}
	 return $this->field_errors;
  }
  /*  Check email fields */
  public function check_EmailAddr($emailaddr){
  	if(!empty($_POST[$emailaddr]) && !preg_match( "/^[_\w-]+(\.[_\w-])*@[_\w-]+(\.[\w]+)*(\.[\w]{2,3})$/i",$_POST[$emailaddr])){
		$this->field_errors[$emailaddr] ="* invalid email address provided";
	}
	return $this->field_errors;
  }
  /* Checks if file uploaded is verified*/
  public function check_uploadFiletype($filetype,array$mimetype,$filename){
  	if(!array_key_exists($filetype,$mimetype)&& !empty($filename)){
	  	 $this->field_errors[$this->upload_fieldname] = "{$filename} is not allowed,choose the correct format"; 
		}
    return $this->field_errors;
  }
  public function check_uploadFileExists($filelocation,$filename){
  	    if(file_exists($filelocation) && !empty($filename)){
	   	$this->field_errors[$this->upload_fieldname] = "File {$filename} already exists";
	   	}
		return $this->field_errors;
  }
  public function check_uploadFileSize($filesize,$filename){
  	   if(($filesize > $_REQUEST['MAX_FILE_SIZE'] || $filesize > UploadFiles::SET_MAX_FILE_SIZE)&& !empty($filename)){
	     $this->field_errors[$this->upload_fieldname] = "File {$filename} is too large";
	  	}
	   return $this->field_errors;
  }
  /* Checks to find if passwords match in two fields. */
 public function check_PasswordFields($password,$confirmpass){
 	    if(strcasecmp($_POST[$password], $_POST[$confirmpass]) != 0){
		$this->field_errors[$confirmpass] ="* Password entered did not match"; 
		}
   return $this->field_errors;
  }
 /* Checks dates by formates */
 public function checkFormDate($dateformat='09/10/2013'){
 	$regex ="~^[0-9]{2}\\/[0-9]{2}\\/[0-9]{4}|[0-9]{2}\-[0-9]{2}\-[0-9]{4}$~";
     if(!empty($_POST[$dateformat]) && !preg_match($regex, $_POST[$dateformat])){
     	$this->field_errors[$dateformat] ="* Invalid date format,must be dd/mm/yyyy";
      }
	 return $this->field_errors;
 }
 public function check_number($number,$format=''){
 	    $format = ($format=="phone")?"/[0-9-?]/":"/[0-9]/";
 	if(!empty($_POST[$number]) && !preg_match($format,$_POST[$number])){
		$this->field_errors[$number]= "* {$number} must be digits";
 	}
	return $this->field_errors;
 }
 public function check_Radio_n_CheckBox($items_array,$checkeditem){
 	//put validation rules
 }
 /* Display Errors in a form */
 public function displayErrors($error_array){
	$output = "<ol class=\"errors\">";
	foreach($error_array as $error) {
	  $error = str_ireplace("_", " ", $error);
	  $output .="<li> " . $error . "</li>";
    }
	$output .="</ol>";
	return $output;
 }
  /* Display Errors in a form */
 public function displayErrorField($err_array,$fieldname){	
 	if(is_array($err_array)){
 	   foreach($err_array as $key=>$value){
 	  	$err_array[$key] = str_ireplace("_", " ", $value);
 	    }
 	    if(array_key_exists($fieldname, $err_array)){
 		  return $err_array[$fieldname];
 	    }
	 }
   }
 }

class  ProcessForm{
	 public $successflag = true;
	 public $errorinfo = array();//add each error to the end of this array
	 public $successmsg="";
	 public $message;
	 public function submitForm(){
	 	  return ($_SERVER["REQUEST_METHOD"]=="POST"?true:false);
	 } 
	 public function post($poststr,$input_val=''){
	 	return (isset($_POST[$poststr]))?trim(filter_var($_POST[$poststr],FILTER_SANITIZE_STRING)):htmlentities($input_val);
	 }
	  public function postFiles($poststr,$input_val=''){
	 	return (isset($_FILES[$poststr]["name"]))?strip_tags($_FILES[$poststr]["name"]):htmlspecialchars($input_val);
	 }
	
	 public function message($msg=''){
	 	//if no errors are found
	 if(count($this->errorinfo)==0 && $this->successflag == true){
	   $this->successmsg .= $msg;
	 }else{
	 	// Display Error Msg Here
		  if(count($this->errorinfo)==1){
		  	$this->successflag = false;
		  	$msg = "There is ".count($this->errorinfo)." error in the form field";
		  }elseif(count($this->errorinfo) > 1){
		  	$this->successflag = false;
		  	$msg = "There are ".count($this->errorinfo)." errors in the form fields";
		  }
		} 
	   return $this->message = ($this->successflag==true)?"<p class=\"successmsg\">".$this->successmsg."</p>":"<p class=\"error\">".$msg."</p>";
	 }
         /* This function validate input forms */
	 static function validate(){
	 	return new FormValidator();
	 }
}
 
 $process = new ProcessForm();
 $validate = ProcessForm::validate();




