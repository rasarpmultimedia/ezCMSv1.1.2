<!DOCTYPE HTML>
<html lang="en-gb">
<head>
<title>Test page</title>
</head>
<body>
<?php
include_once"includes/initialize.inc.php";
//Create a test form here
$form = new Form();
$form->startForm("testform",$_SERVER['PHP_SELF'],"post","enctype='www-form/application'");
//Firstname
$form->setFormField($form->inputLable("firstname", "Firstname"),
				    $form->inputField("text", "firstname",$process->post("firstname")),
				    $errormsg='');
//Lastname
$form->setFormField($form->inputLable("lastname", "Lastname"),
					$form->inputField("text", "lastname",$process->post("lastname")),
					$errormsg='');
//Gender
$gender_options = array('Select Gender','Male','Female');
$form->setFormField($form->inputLable("gender", "Gender"),
					$form->selectOptions("gender",$gender_options,$process->post("gender")),
					$errormsg='');
//Username
$form->setFormField($form->inputLable("username", "Username"),
     				$form->inputField("text", "username",$process->post("username")),
     				$errormsg='');
//Email Address
$form->setFormField($form->inputLable("email", "Email"),
					$form->inputField("email", "email_address",$process->post("email_address")),
					$errormsg='');
//Password
$form->setFormField($form->inputLable("password", "Password"),
					$form->inputField("password", "password",$process->post("password")),
					$errormsg='');
//Confirm password					
$form->setFormField($form->inputLable("confirm_password", "Confirm Password"),
					$form->inputField("password","confirm_password",$process->post("confirm_password")),
					$errormsg='');
//Submit Form
$form->setFormField(null,$form->inputField("submit", "send","Send"));
echo $form->DisplayFields("Top Labling");
$form->endForm();
?>
</body></html>
