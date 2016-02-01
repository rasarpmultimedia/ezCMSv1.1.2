<?php
/*Declaring routines for registeration*/
function register(){
//put contents here
include_once"../includes/admin_init.php";
$process  = new ProcessForm;
$validate = $process::validate();
$postdata = new User("users");
$id = $postdata::$id = isset($GLOBALS["id"])?"Id=".$GLOBALS["id"]:null;//id recieved form querystring
if($GLOBALS["action"]=="editregister"){
        $edit   = $postdata::findRow($id);//
        $firstname   = $edit->Firstname;
        $lastname    = $edit->Lastname;
        $gender      = $edit->Gender;
        $username    = $edit->Username;
        $email       = $edit->Email;
 }else{
        $firstname     = "";
        $lastname      = "";
        $gender        = "";
        $username      = "";
        $password      = "";
        $email         ="";
 }
if($process->submitForm()){
  /*@setting validation rules*/
  $required = array("firstname","lastname","gender","username","email_address");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
  $check_invalidchars = array("firstname","lastname","username");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_invalidChars($check_invalidchars));
  $requiredlen = array("firstname"=>50,"lastname"=>50,"username"=>50);
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_FieldLength($requiredlen));
  //$selectedindex = $setuserlevel==true?array("gender"=>"--Select Gender--","ulevel"=>"--Select User Level--"):array("gender"=>"--Select Gender--");
  //$process->errorinfo = array_merge($process->errorinfo,$validate->check_selectField($selectedindex));
  
  if($_POST){
  	$getrow = $postdata::fieldExists("Username={$_POST["username"]}"); 
    //$uservalidate = (isset($_POST["username"]))?$getrow->Username:null;
   if($getrow!=null){$process->errorinfo["username"] = $_POST["username"]." already a users, try anther username please";}
   }
  
  if($GLOBALS["action"]=="register" || $GLOBALS["action"]=="adduser"){
  array_push($required,"password");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_PasswordFields("password", "cpassword"));
  }
  //Sucess
 //$process->message("Hey successfully submmited the form");
 $linkto = GenerateUrl::buildLink("../auth",".","Login");
 $process->message("Your registeration was successfully, please you can $linkto  now.");
  if($process->successflag){
	//echo "success happened and all fields are sent to database, Thank you ! :)";
          $postdata::$tablefields = array(
          "Firstname"     => $_POST["firstname"],
          "Lastname"      => $_POST["lastname"],
          "Gender"        => $_POST["gender"],
          "Username"      => $_POST["username"],
          "Email"         => $_POST["email_address"],
          "Password"      => md5($_POST["password"]));
		  $postdata->save();
	      
  }
}
$querystr = isset($_SERVER['QUERY_STRING'])?"?".$_SERVER['QUERY_STRING']:null;
$form = new Form("Register",$_SERVER['PHP_SELF'].$querystr,"post","enctype=\"application/x-www-form-urlencoded\"\n");
$form->startForm();
//form heading
if($GLOBALS["action"]=="editregister"){
    $form->setFormField(null,$form->addFormInfo("<h2>Edit your profile ..</h2>")); 
}elseif ($GLOBALS["action"]=="edituser") {
   $form->setFormField(null,$form->addFormInfo("<h2>Edit User Account</h2>"));    
}else{
$form->setFormField(null,$form->addFormInfo("<h2>Use this form to add register new users..</h2>"));	
}

//FIrstname
$form->setFormField($form->inputLabel("firstname", "Firstname"),
        $form->inputField("text", "firstname",$process->post("firstname",$firstname)),
        $validate->displayErrorField($process->errorinfo, "firstname"));
//Lastname
$form->setFormField($form->inputLabel("lastname", "Lastname"),
$form->inputField("text","lastname",$process->post("lastname",$lastname)),
$validate->displayErrorField($process->errorinfo, "lastname"));

//gender
$gender_options = array("--Select Gender--","M"=>"Male","F"=>"Female");
$form->setFormField($form->inputLabel("gender", "Gender"),
$form->selectOptions("gender", $gender_options,$process->post("gender",$gender)),
$validate->displayErrorField($process->errorinfo, "gender"));

//Username
$form->setFormField($form->inputLabel("username", "Username"),
        $form->inputField("text","username",$process->post("username",$username)),
        $validate->displayErrorField($process->errorinfo, "username"));

//Email Address
$form->setFormField($form->inputLabel("email", "Email"),
        $form->inputField("email", "email_address",$process->post("email_address",$email)),
        $validate->displayErrorField($process->errorinfo, "email_address"));

//checks userlevel					

//if in edit mode
if($GLOBALS["action"]!="editregister"){
  //Password
$form->setFormField($form->inputLabel("password", "Password"),
        $form->inputField("password", "password",$process->post("password")),
        $validate->displayErrorField($process->errorinfo, "password"));
$form->setFormField($form->inputLabel("cpassword", "Confirm Password"),
        $form->inputField("password", "cpassword",$process->post("cpassword")),
        $validate->displayErrorField($process->errorinfo, "cpassword"));  
}

//Submit Form
$hyperlink = GenerateUrl::buildLink("..", ".","Terms and Conditions of use","target=terms.html");
//checks submit type
if($GLOBALS["action"]=="editregister"){
    $form->setFormField(null,$form->inputField("submit", "send","Update My Profile "));
}else{
$form->setFormField(null,
$form->addFormInfo("<strong role=\"agreement\">By Clicking on Register you Agree to our {$hyperlink}.</strong>"));
 $form->setFormField(null,$form->inputField("submit", "send","Register"));
}
$form->endForm();
return $form->DisplayFields($GLOBALS["form_labling"],$process->message);
}