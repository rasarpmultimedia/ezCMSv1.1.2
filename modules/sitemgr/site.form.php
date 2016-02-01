<?php
//include_once"../../includes/initialize.inc.php";
function siteNavForm(){
	//put contents here
	$process  = new ProcessForm();
    $menudata = new Table("sitemenu");
	$validate = $process::validate();
	if($GLOBALS["action"]=="editsitenav"){
		$menudata::$id = "Id=".$GLOBALS["id"];// Get Id //
		$editmenu = $menudata::findRow($menudata::$id);
		//set edit field variables;
		$menu_name  = $editmenu->Nav_name;
		$menu_type  = $editmenu->Nav_type;
		$menu_level = $editmenu->Nav_level;
		$menu_position = $editmenu->Position;
		$menu_visible  = $editmenu->Visible;
		$menu_featured = $editmenu->Featured;
	}else{
		$menu_name 	= "";
		$menu_type 	= "";
		$menu_level	= "";
		$menu_position ="";
		$menu_visible  ="";
		$menu_featured ="";
	}
	
	if($process->submitForm()){
		/*@setting validation rules*/
		$required = array("menu_name","menu_type","menu_level");
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
		$check_invalidchars = array("menu_name","menu_type");
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_invalidChars($check_invalidchars));
		$requiredlen = array("menu_name"=>100);
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_FieldLength($requiredlen));
		$selectedindex = array("menu_type"=>"--Select Menu Type--","position"=>"--Select Menu Position--");
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_selectField($selectedindex));
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_number("menu_level"));
		$getrow = $menudata::fieldExists("Nav_name={$_POST["menu_name"]}");
		if($getrow){
		 	$process->errorinfo["menu_name"] = $_POST["menu_name"]." already exist try another name";
		 }
		$process->message("Menu has been successfully submitted.");
		if($process->successflag){
			$menudata::$tablefields= array(
            "Nav_name"=> $_POST["menu_name"],
			"Nav_type"=>$_POST["menu_type"],
			"Nav_level"=>$_POST["menu_level"],
			"Position"=>$_POST["position"],
			"Visible"=>$_POST["visible"],
			"Featured"=>  $_POST["feature"]);
			$menudata->save();
			//echo "success happened and all fields are sent to database, Thank you ! :)";
		}
	}
	$form = new Form("sitenavform",$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],"post","enctype=\"application/x-www-form-urlencoded\"\n");
	//Company;
	$form->startForm();
	$form->setFormField("",
	$form->addFormInfo($form->addFormInfo(
           "<p>".GenerateUrl::buildLink(".","dashboard.php","&laquo;Back to  Sammary Page","action=view,target=managesite")."</p>"
          ."<h2>Use this form to add New Navigation Menu to your site</h2><p>Required Fields are labelled with asterics (*)</p><hr/>")));
				 
	////Nav_name,Nav_type,Nav_level,Position,Visible ,Featured
	$form->setFormField($form->inputLabel("menu_name", "*Menu Name"),
			$form->inputField("text", "menu_name",$process->post("menu_name",$menu_name)),
			$validate->displayErrorField($process->errorinfo, "menu_name"));
	//Menu type
	$menutype_opts  = array("--Select Menu Type--","Horizontal"=>"Horizontal","Vertical"=>"Vertical");
	$form->setFormField($form->inputLabel("menu_type", "*Menu Type"),
			$form->selectOptions("menu_type",$menutype_opts,$process->post("menu_type",$menu_type)),
			$validate->displayErrorField($process->errorinfo, "menu_type"));
	//Menu Level
	$form->setFormField($form->inputLabel("menu_level", "*Menu Level"),
			$form->inputField("number", "menu_level",$process->post("menu_level",$menu_level)),
			$validate->displayErrorField($process->errorinfo, "menu_level"));
	//Position
	$menuposition =function(){ 
	     $getposition  = new Table("sitemenu");
		 $position_options = $getposition::countRows();
		 $options[] ="--Select Position--";
		 for($count=1; $count<=($position_options->Totalrows+1); $count++){
		  $options[] = $count; 	 	
		 } return $options; 
	};
	$form->setFormField($form->inputLabel("position", "*Menu Position"),
			$form->selectOptions("position",$menuposition(),$process->post("position",$menu_position)),
			$validate->displayErrorField($process->errorinfo, "position"));
			
	//Radio for Visible/
	$form->setFormField($form->inputLabel("visible", "Menu Visibility"),
			$form->radioButton("Yes","visible","Y",($process->post("visible",$menu_visible)=="Y"?true:false)).
			$form->radioButton("No","visible","N",($process->post("visible",$menu_visible)=="N"?true:false)));
	//Featured 
	$form->setFormField($form->inputLabel("feature", "Feature"),
			$form->radioButton("Yes","feature","Y",($process->post("feature",$menu_featured)=="Y"?true:false)).
			$form->radioButton("No","feature","N",($process->post("feature",$menu_featured)=="N"?true:false)));
	//Submit Form
	$form->setFormField(null,$form->inputField("submit", "send","Save"));
	$form->endForm();
	return $form->DisplayFields($GLOBALS["form_labling"],$process->message);
}

function categoryForm(){
	//put contents here
	$process  = new ProcessForm();
	$validate = $process::validate();
	$postdata = new Table("pagecategory");
	
	if($GLOBALS["action"]=="editpgcate"){
		$postdata::$id = "Id=".$GLOBALS["id"];
		$editcate = $postdata::findRow($postdata::$id);
		$category = $editcate->Category;
		$visible  = $editcate->Visible;
		$position = $editcate->Position;
    }else{
		$category ="";
		$visible  ="";
		$position ="";
	}
	if($process->submitForm()){
		/*@setting validation rules*/
		$required = array("category");
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_requiredFields($required));
		$check_invalidchars = array("category");
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_invalidChars($check_invalidchars));
		$requiredlen = array("category"=>30);
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_FieldLength($requiredlen));
		$selectedindex = array("position"=>"--Select Menu Position--");
		$process->errorinfo = array_merge($process->errorinfo,$validate->check_selectField($selectedindex));

		$process->message("category has been successfully submmited.");
		if($process->successflag){
			//echo "success happened and all fields are sent to database, Thank you ! :)";//
			$postdata::$tablefields=array(
			"Category"=>$_POST["category"],
			"Position"=> $_POST["position"],
			"Visible"=>  $_POST["visible"]
			);
			$postdata->save();
		}
	}
	$form = new Form("sitenavform",$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],"post","enctype=\"application/x-www-form-urlencoded\"\n");
	//Company
	$form->startForm();
	$form->setFormField("",
	$form->addFormInfo("<p>".GenerateUrl::buildLink(".","dashboard.php","&laquo;Back to Sammary Page","action=view,target=managesite")."</p>"."<h2>Use this form to add new page category.</h2><p>Required Fields are labelled with asterics (*)<hr/>"));
	
	//Category
	$form->setFormField($form->inputLabel("category", "*Category Name"),
			$form->inputField("text", "category",$process->post("category",$category)),
			$validate->displayErrorField($process->errorinfo, "category"));
	//Position
	$cateposition =function(){
		$getposition  = new Table("sitemenu");
		$position_options = $getposition::findAllRecords("ORDER BY Id ASC");
		foreach ($position_options as $opt){
			$options[0] ="--Select Menu Position--";
			$options[$opt->Position] = $opt->Nav_name; 
		}
	return $options;
	};
	$form->setFormField($form->inputLabel("position", "*Menu Position"),
			$form->selectOptions("position",$cateposition(),$process->post("position",$position)),
			$validate->displayErrorField($process->errorinfo, "position"));

	//Radio for Visible//
	$form->setFormField($form->inputLabel("visible", "Menu Visibility"),
			$form->radioButton("Yes","visible","Y",($process->post("visible",$visible)=="Y"?true:false)).
			$form->radioButton("No","visible","N",($process->post("visible",$visible)=="N"?true:false)));
	//Submit Form//
	$form->setFormField(null,$form->inputField("submit", "send","Save"));
	$form->endForm();
	return $form->DisplayFields($GLOBALS["form_labling"],$process->message);
}

