<?php
function pageform(){
    global $session;
    $process  = new ProcessForm();
$validate = $process::validate();
$postdata = new Page("pages");
$user = new User("users");
$uid  = $user::findRow("Id={$session->userid}");//change this to login session id when login is activated
$id = $postdata::$id = isset($GLOBALS["id"])?"Id=".$GLOBALS["id"]:null;//id recieved form querystring
 if($GLOBALS["action"]=="editpage"){
 	
	$edit = $postdata::findRow($id);//
	$title 	   = $edit->Title;
	$category  = $edit->Position;
	$source    = $edit->Source;
	$pgcontent = $edit->Content;
	$published = $edit->Published;
	$featured  = $edit->Featured;
	$authorid  = $uid->Id;
	//image to upload
	$pgimage   = "";
	$imgcaption= "";	
 }else{
 	$title = "";
	$category   = "";
	$source     = "";
	$pgcontent  = "";
	$published  = "";
	$featured   = "";
	$authorid   = $uid->Id;
    //image to upload
	$pgimage   = "";
	$imgcaption= "";
	//debug($authorid);
 }
//Process Page Form
 //Process Image Uploads here
$upload_path="../"; 

$upload = new UploadFiles($upload_path.PAGEIMG_DIR,$upload_path.TEMP_DIR);
if($process->submitForm()){
  /*@setting validation rules*/
  $upload->Mimetype = array('image/pjpeg'=>"jpeg", 'image/jpeg'=>"jpeg", 'image/png'=>"png", 'image/gif'=>"gif");
    
  $required = array("title","page_content","source");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
  $check_invalidchars = array("title",/*"page_content",*/"source");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_invalidChars($check_invalidchars));
  $requiredlen = array("title"=>100);
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_FieldLength($requiredlen));
  $selectedindex = array("category"=>"--Select Category--");
  $process->errorinfo = array_merge($process->errorinfo,$validate->check_selectField($selectedindex));
  if($id==null){ 
   $getrow = $postdata::fieldExists("Title={$_POST["title"]}");
   if($getrow){$process->errorinfo["title"] = $_POST["title"]." already exist";}
  }
/* upload info on validation ,//Sucess*/
  $massage = $process->message("Page has been successfully submmited.");
  if($process->successflag){
  	//put database table here
  	$postdata::$tablefields=array(
  	"Title"	=>$_POST["title"],
  	"Content"	=>$_POST["page_content"],
  	"Source"	=>$_POST["source"],
  	"Postedby"	=>$_POST["authorid"],
  	"Position"	=>$_POST["category"],
  	"Published"	=>$_POST["publish"],
  	"Featured"	=>$_POST["feature"]
	);
	/*saved to database*/	
	$postdata->save();
    //echo "new recored was added with id=".$postdata->lastInsertedId();
	//echo "<br> success happened and all fields are sent to database, Thank you ! :)";
	/*uploads info*/
	$upload->uploadFile("uploadimg");//upolads an image
   	if($upload->Upload_status==true){
   	$postimg  = new Image("pageimgs");
   	$pageid = $id<>null?$id:$postdata->lastInsertedId();
	$postimg::$tablefields=array(
	"Imgname"	=>$upload->Newfilename,
	"Width"		=>$upload->Width,
	"Height"	=>$upload->Height,
	"Imgcaption"=>$_POST["imgcaption"],
	"Mimetype"	=>$upload->Filetype,
	"Extention"	=>$upload->File_ext,
	"Pageid"	=>$pageid
	);
	//check and delete old image record in pageimg table
	$pid = $postimg->findRow("Pageid=".$pageid);
	if($pid <>null){
	 //if(file_exists($upload_path.PAGEIMG_DIR.$pid->Imgname.".".$pid->Extention)){
	  $upload->deleteFile($upload_path.PAGEIMG_DIR.$pid->Imgname.".".$pid->Extention);
	  $upload->deleteFile($upload_path.PAGEIMG_DIR."thumbnails/".$pid->Imgname.".".$pid->Extention);}
	// }
	$postimg->save();
	}
  }
  //upload image 
}
$form = new Form("Pageform",filter_var($_SERVER['PHP_SELF'])."?".filter_var($_SERVER['QUERY_STRING']),"post","enctype=\"multipart/form-data\"\n");
//Company;
$form->startForm();
$form->setFormField("",
$form->addFormInfo("<h2>Use this form add new Page..</h2><p>Required Fields are labelled with asterics (*)</p><hr/>"));
//Page Title
$form->setFormField($form->inputLabel("title", "*Title"),
					$form->inputField("text", "title",$process->post("title",$title)),
					$validate->displayErrorField($process->errorinfo, "title"));
//Category
$pgcategory=function(){
$category  = new GetTableRecord("pagecategory");$category_options = $category::findAllRecords();
$options[] ="--Select Category--";
foreach ($category_options as $opt)$options[$opt->Position] = $opt->Category ; return $options;
};

$form->setFormField($form->inputLabel("category", "*Category"),
					$form->selectOptions("category",$pgcategory(),$process->post("category",$category)),
					$validate->displayErrorField($process->errorinfo, "category"));

//Page Source
$form->setFormField($form->inputLabel("source", "*Source"),
					$form->inputField("text", "source",$process->post("source",$source)),
					$validate->displayErrorField($process->errorinfo, "source"));
// Page Content
$form->setFormField($form->inputLabel("page_content", "*Content"),
					$form->textAreaField("page_content",$process->post("page_content",$pgcontent),"10","50","class=\"ckeditor\""),
					$validate->displayErrorField($process->errorinfo, "page_content"));
//Upload Image
$form->setFormField($form->inputLabel("uploadimg", "Upload Image"),
					$form->uploadField("uploadimg[]","uploadimg")."<br>".$form->textAreaField("imgcaption",$process->post("imgcaption",$imgcaption),"1","45",'placeholder="Image Caption"')
					.$form->inputField("hidden","MAX_FILE_SIZE","40000000")
					,$validate->displayErrorField($process->errorinfo, "uploadimg"));
//Radio for Visible/			
$form->setFormField($form->inputLabel("publish", "Publish"),
					$form->radioButton("Yes","publish","Y",($process->post("publish",$published)=="Y"?true:false)).
					$form->radioButton("No","publish","N",($process->post("publish",$published)=="N"?true:false)));
//Featured Page					
$form->setFormField($form->inputLabel("feature", "Feature"),
					$form->radioButton("Yes","feature","Y",($process->post("feature",$featured)=="Y"?true:false)).
					$form->radioButton("No","feature","N",($process->post("feature",$featured)=="N"?true:false)));
//Submit Form
$form->setFormField(null,
/*$form->inputField("hidden","pageid",$process->post("pageid",$pageid)).*/
$form->inputField("hidden","authorid",$process->post("authorid",$authorid)).
$form->inputField("submit", "send","Save"));
$form->endForm();
return $form->DisplayFields($GLOBALS["form_labling"],$process->message);
}
