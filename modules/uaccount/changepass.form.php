<?php
/*Declaring routines for registeration*/
function changePassword(){
//put contents here
include_once"../includes/admin_init.php";
$process  = new ProcessForm;
$validate = $process::validate();
$postdata = new User("users");
$id = $postdata::$id = isset($GLOBALS["id"])?"Id=".$GLOBALS["id"]:null;//id recieved form querystring

if($process->submitForm()){
  /*@setting validation rules*/
  $required = array("old_password","new_password");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_PasswordFields("new_password","cpassword"));

 //$process->message("Hey successfully submmited the form");
 
 $linkto = GenerateUrl::buildLink("../auth",".","Login");
  $process->message("Your password was successfully changed, please you can $linkto now."); 
  if($process->successflag){
	//echo "success happened and all fields are sent to database, Thank you ! :)";
	   $oldpass = isset($_POST["old_password"])?md5($_POST["old_password"]):null;
	   $getrow = $postdata::fieldExists("Password={$oldpass}");
	   var_dump($getrow);
	   if($getrow!=null){
          $postdata::$id = isset($GLOBALS["id"])?"Id=".$GLOBALS["id"]:null;
          $postdata::$tablefields = array("Password"  => md5($_POST["new_password"]));
		  $postdata->save();
        }
	} 

 }

$querystr = isset($_SERVER['QUERY_STRING'])?"?".$_SERVER['QUERY_STRING']:null;
$form = new Form("changepass",$_SERVER['PHP_SELF'].$querystr,"post","enctype=\"application/x-www-form-urlencoded\"\n");
$form->startForm();
//form heading
  $form->setFormField(null,$form->addFormInfo("<h2>Change My Password</h2>")); 
//Password
$form->setFormField($form->inputLabel("Old password", "*Old Password"),
        $form->inputField("password", "old_password",$process->post("old_password")),
        $validate->displayErrorField($process->errorinfo, "old_password"));
  //Password
$form->setFormField($form->inputLabel("new_password", "*New Password"),
        $form->inputField("password", "new_password",$process->post("new_password")),
        $validate->displayErrorField($process->errorinfo, "new_password"));

$form->setFormField($form->inputLabel("cpassword", "*Confirm Password"),
        $form->inputField("password", "cpassword",$process->post("cpassword")),
        $validate->displayErrorField($process->errorinfo, "cpassword"));  

//checks submit type
$form->setFormField(null,$form->inputField("submit", "change","Change My Password"));

$form->endForm();
return $form->DisplayFields($GLOBALS["form_labling"],$process->message);
}