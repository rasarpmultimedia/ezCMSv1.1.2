<?php 
include_once"../includes/admin_init.php";
if($session->isLoggedIn() && $session->isAdmin()){ redirectTo("../admin/");}
//$GLOBALS["form_labling"] = "Login Labling"; change to this after
function loginForm(){ global $process,$session;
$user = new User;
//$uid  = $user::findRow("Id=1");
// Proccessing forms   
  if($process->submitForm()){
	  // Form validation and processing
    if($session->isLoggedIn()){
		 $msg = "* {$_POST["username"]} is already logged in";
       }
     //if no errors are found 
    $username  = $process->post("username");
	$password  = $process->post("password");
	$password  = md5($password);
	if(!$user::userExists("Username={$username}")){
	   $msg = "Username does not exist, register it now!"; 
       }
	 $authuser  = $user::authenticate($username,$password);
	 if($authuser){
	 	$session->LogIn($authuser);
	 	redirectTo("../admin/");
        //echo "you  are now logged in";  
	 }else{
	 	$msg = "Username and Password combination is not correct";
	 }
}else{
	$email ="";
	$password ="";
}

//login form
$form = new Form("login",filter_var($_SERVER['PHP_SELF']),"post","enctype=\"application/x-www-form-urlencoded\"\n");
$form->startForm();
$form->setFormField("",$form->addFormInfo(
"<p style=\"text-align:center;\">Enter your username and password to access admin dashboard<br>
<img  src=\"../".TEMPLATE_DIR.SITE_TEMPLATE."/_images/login_icon.png\" /></p>"
));
if(isset($msg)&&strlen($msg)>0){$form->setFormField("",$form->addFormInfo("<p  class=\"error\">$msg</p>"));}
//Username
$form->setFormField($form->inputLabel("username", "Username"),
                               $form->inputField("text", "username","",'autocomplete="on"'));
$form->setFormField($form->inputLabel("username", "Password"),
                               $form->inputField("password", "password",""));
$form->setFormField("",$form->inputField("submit","login","Login").
" or ".GenerateUrl::buildLink("../auth","register.php","Register"));
return $form->DisplayFields($GLOBALS["form_labling"]);
$form->endForm();
}
//Desplaying output to page
$template->setPage("Title", "Admin::Login");
$template->setPage("Content",loginForm());
$template->setPage("Footer",ADMIN_FOOTER);
include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;
;
?>