<?php
$bizform = function(){
//include_once"../../includes/initialize.inc.php";
$form = new Form();
$process  = new ProcessForm();
$validate = $process::validate();
/*
 *  
Id ;
Company ;
Title;
Empstatus ;
Category; 
Description;
Education;
Experience;
Location;
Region;
Contactaddr;
Phone;  
Email;
Website;
Deadline;
Lastupdated;
Listedby; 
Position; 
 * */
 if(isset($GLOBALS["action"])=="edit"){
 	$id = $GLOBALS["id"]; 
 	$editbiz = BusinessDirectory::findById($id);
 }
if($process->submitForm()){
  /*@setting validation rules*/
  $required = array("company","address","website","location","cellphone","description");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
  $check_invalidchars = array("company","address","website","location","description");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_invalidChars($check_invalidchars));
  $requiredlen = array("company"=>80,"address"=>50,"website"=>255,"location"=>50,"phone"=>10);
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_FieldLength($requiredlen));
  $selectedindex = array("category"=>"--Select Category--","region"=>"--Select Region--");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_selectField($selectedindex));
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_number("cellphone", "phone"));
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_number("fax", "phone"));
  //sucess
  $process->message("Hey successfully submmited the form");
  if($process->successflag){
	echo "success happened and all fields are sent to database, Thank you ! :)"; 
  	//put database table here
  }
}
//Create form
//array("company","address","website","location","cellphone","fax","description");
// $process->successmsg ="Hey successfully submmited the form";
echo $process->message();
//if(strlen(@$msg) > 0) echo "<p class=\"error\">".$msg."</p>";
 $form->startForm("Addbusiness",$_SERVER['PHP_SELF'],"post","enctype=\"application/x-www-form-urlencoded\"")."\n";
//Company
$form->setFormField($form->inputLable("company", "Company"),
				    $form->inputField("text", "company",$process->post("company")),
				    $validate->displayErrorField($process->errorinfo, "company"));
//Category
$category_options = array('--Select Category--',"IT");
$form->setFormField($form->inputLable("category", "Category"),
					$form->selectOptions("category",$category_options,$process->post("category")),
					$validate->displayErrorField($process->errorinfo, "category"));
//Location Address
$form->setFormField($form->inputLable("address", "Address"),
					$form->textAreaField("address",$process->post("address"),"2","20"),
					$validate->displayErrorField($process->errorinfo, "address"));
//Region
$region_options = array('--Select Region--',"GT");
$form->setFormField($form->inputLable("region", "Region"),
					$form->selectOptions("region",$region_options,$process->post("region")),
					$validate->displayErrorField($process->errorinfo, "region"));
//Website Address
$form->setFormField($form->inputLable("website","Website (URL)"),
     				$form->inputField("url", "website",$process->post("website")),
     				$validate->displayErrorField($process->errorinfo, "website"));
//Email Address
$form->setFormField($form->inputLable("email", "Email"),
					$form->inputField("email", "email_address",$process->post("email_address")),
					$validate->displayErrorField($process->errorinfo, "email_address"));
// Location Address
$form->setFormField($form->inputLable("location","Location"),
     				$form->inputField("text", "location",$process->post("location")),
     				$validate->displayErrorField($process->errorinfo, "location"));

//Cellphone
$form->setFormField($form->inputLable("cellphone", "Cellphone"),
					$form->inputField("tel", "cellphone",$process->post("cellphone")),
					$validate->displayErrorField($process->errorinfo, "cellphone"));
//Fax
$form->setFormField($form->inputLable("fax", "Fax (Optional)"),
					$form->inputField("tel", "fax",$process->post("fax")),
					$validate->displayErrorField($process->errorinfo, "fax"));
// Location Address
$form->setFormField($form->inputLable("description", "Business Description"),
					$form->textAreaField("description",$process->post("description"),10,40),
					$validate->displayErrorField($process->errorinfo, "description"));

//Submit Form
$form->setFormField("",
$form->addFormInfo("<p>By Clicking on Send you Agree to our terms and conditions of use.</p>"));
//
$form->setFormField(null,$form->inputField("submit", "send","Send"));
$form->DisplayFields($GLOBALS["form_labling"]);
$form->endForm();
//put form input here
};
echo $bizform();
