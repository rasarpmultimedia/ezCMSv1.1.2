<?php
function commentform($pageid){
    //global $session;
    $process  = new ProcessForm();
	$validate = $process::validate();
	$postcomment = new Table("Comments");
		//Process Page Form
		if($process->submitForm()){
		  /*@setting validation rules*/
		  $required = array("name","comment");
		  $process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
		  $massage = $process->message("Comment has been successfully submmited.");
		  //$sucessmsg = $_REQUEST["msg"]=$massage;
		  if($process->successflag){
		  	//put database table here
		  	$postcomment::$tablefields=array(
		  	"Name"=>$process->post("name"),
		  	"Comment"	=>$process->post("comment"),
		  	"Pageid"	=>$pageid
			);
			/*saved to database*/	
			$postcomment->save();
		    //echo "new recored was added with id=".$postcomment->lastInsertedId();
			//echo "<br> success happened and all fields are sent to database, Thank you ! :)"; 
		 }
		}
$form = new Form("commentform",filter_var($_SERVER['PHP_SELF'])."?".filter_var($_SERVER['QUERY_STRING']),"post");
//Company;
$form->startForm();
$form->setFormField("",
$form->addFormInfo("<h2>Comment Form</h2>"));
//Page Title
$form->setFormField($form->inputLabel("name", "*Name"),
					$form->inputField("text", "name",$process->post("name")),
					$validate->displayErrorField($process->errorinfo, "name"));

// Page Content
$form->setFormField($form->inputLabel("comment", "*Comment (HTML is not allowed)"),
					$form->textAreaField("comment",$process->post("comment"),10,45,'placeholder="Type comment here"'),
					$validate->displayErrorField($process->errorinfo, "comment"));
//Submit Form
$form->setFormField(null,
$form->inputField("hidden","userid",$process->post("userid",$authorid="")).
$form->inputField("submit", "submit","Add Comment"));
$form->endForm();
return $form->DisplayFields($GLOBALS["form_labling"],$process->message);
}