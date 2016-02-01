<?php
function businessdirform(){
//put contents here
//include_once"../../includes/initialize.inc.php";
$process  = new ProcessForm();
$validate = $process::validate();
 if(isset($GLOBALS["action"])=="edit"){
 	//$id = $GLOBALS["id"]; 
 	//$editbiz = BusinessDirectory::findById($id);
 }
if($process->submitForm()){
  /*@setting validation rules*/
  $required = array("company","address","website","email_address","location","cellphone","business_description");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
  $check_invalidchars = array("company","address","website","location","description");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_invalidChars($check_invalidchars));
  $requiredlen = array("company"=>80,"address"=>50,"website"=>255,"location"=>50,"phone"=>15);
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_FieldLength($requiredlen));
  $selectedindex = array("category"=>"--Select Category--","region"=>"--Select Region--");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_selectField($selectedindex));
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_number("cellphone", "phone"));
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_number("fax", "phone"));
  //Sucess
  $process->message("Hey successfully submmited the form");
  if($process->successflag){
	echo "success happened and all fields are sent to database, Thank you ! :)"; 
  	//put database table here
  }
}
$form = new Form("Addbusiness",$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],"post","enctype=\"application/x-www-form-urlencoded\"\n");
//Company);
$form->startForm();
$form->setFormField("",
$form->addFormInfo("<h2>Use this form to add Bussiness Profiles..</h2>"));
$form->setFormField($form->inputLable("company", "Company"),
				    $form->inputField("text", "company",$process->post("company")),
				    $validate->displayErrorField($process->errorinfo, "company"));
//Category
$bizcategory =function(){
$category  = new GetTableRecord("bizcategory");$category_options = $category::findAllRecords();
$options[] ="--Select Category--";
foreach ($category_options as $opt)$options[] = $opt->Category;	return $options;
};
//$category_options = array('--Select Category--',"IT");
$form->setFormField($form->inputLable("category", "Category"),
					$form->selectOptions("category",$bizcategory(),$process->post("category")),
					$validate->displayErrorField($process->errorinfo, "category"));
//Location Address
$form->setFormField($form->inputLable("address", "Address"),
					$form->textAreaField("address",$process->post("address"),"2","20"),
					$validate->displayErrorField($process->errorinfo, "address"));
//Regions, this fn returns db object into an array
$regions=function(){
$region  = new GetTableRecord("Regions");$region_options = $region::findAllRecords();
$options[] ="--Select Region--";
foreach ($region_options as $opt)$options[] = $opt->Region;	return $options;
};
$form->setFormField($form->inputLable("region", "Region"),
					$form->selectOptions("region",$regions(),$process->post("region")),
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
// Business Description
$form->setFormField($form->inputLable("business_description", "Business Description"),
					$form->textAreaField("business_description",$process->post("business_description"),"10","40"),
					$validate->displayErrorField($process->errorinfo, "business_description"));
//Submit Form
$form->setFormField(null,$form->inputField("submit", "send","Add Bussiness Directory"));
$form->endForm();
return $form->DisplayFields($GLOBALS["form_labling"],$process->message);
};
