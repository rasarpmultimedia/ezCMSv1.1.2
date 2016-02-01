<?php
/*/initialize classes/*/
//include_once"initialize.inc.php";
/*/initialize classes/*/
/**Home page flex box function
 * @method homePageFlexBox($dir_path='') 
 * @param $dir_path specify the directory one level above e.g ../dirname/ /*/
function homePageFlexBox($dir_path=''){
/*/initialize classes/*/
$settings = new GlobalSettings("pages");
$pgcategory = new Table("pagecategory");
$page     = new Page("pages");
$Image = new Image("pageimgs");
/*/initialize classes ends/*/
$pagecat = $pgcategory::findAllRecords();
if($pagecat){
$tp = $settings::countRows();
$settings->Pagelimit = 10;
$paginate = new Pagination($settings->Currentpage,$settings->Pagelimit,$tp->Totalrows);
$paginate->mid_range =  ($tp->Totalrows>100?20:10);
$output =""; $hyperlink = new GenerateUrl;
$pgdescs = $page::findAllRecords("ORDER BY Dateposted DESC LIMIT ".$settings->Pagelimit);
}
/*Link image to flex boxes*/
$image_path = $dir_path.PAGEIMG_DIR;
/*Link image to pages*/
$output ='';
//$output .="<div id=\"accordion\">";
 if(!empty($pagecat)){
     foreach($pagecat as $pcateg){
     if($pcateg->Visible=="Y"){ 
     $output .= "<div class=\"flex_box\">";
     $output .="<h3>Latest {$pcateg->Category}</h3><ol>";
      foreach($pgdescs as $pgdesc){
        if( ($pcateg->Position==$pgdesc->Position) && ($pgdesc->Published=="Y" && $pgdesc->Featured=="Y")){
            $querystr = $paginate->addparam = "id=".$pgdesc->Id.",action=display,target=".$pcateg->Category.",cpos=".$pcateg->Position."";  
            $title_link = $hyperlink::buildLink(".",".","{$pgdesc->Title}",$querystr);
            $continuelink= $hyperlink::buildLink(".",".","read more &raquo;",$querystr);
            $output .="<li><div><h4>{$title_link}</h4>
             <p><time class=\"dateposted\">Date Published : ".formatDate($pgdesc->Dateposted,"datetime_word")."</time></p>
         <p>".$Image->showThumbImage($pgdesc->Id,$image_path."thumbnails/").getPageDesc(bbcode_parser($pgdesc->Content),0,400)."<br>{$continuelink}<hr></div></li>";
           }
         }
      $output .= "</ol></div>";
      /* $output .= "";*/
      }
 }
//$output .="</div>";
return $output;
}
}
 
/**Page flex box function
 * @method pageFlexBox($dir_path='') 
 * @param $dir_path specify the directory one level above e.g ../dirname/ /*/
function pageFlexBox($dir_path=''){ global $template;
/*/initialize classes/*/
$settings = new GlobalSettings("pages");
$pgcategory = new GetTableRecord("pagecategory");
$page     = new Page("pages");
$Image = new Image("pageimgs");
//$users = new User("Users");
$pagecat = $pgcategory::findRow("Position={$settings->Contentpos}");
if($pagecat){
$tp = $settings::countRows("Position={$settings->Contentpos}");
$settings->Pagelimit = 5 ;
$paginate = new Pagination($settings->Currentpage,$settings->Pagelimit,$tp->Totalrows);
$paginate->addparam ="action=view,target=".$pagecat->Category.",cpos=".$pagecat->Position."";
$paginate->mid_range =  ($tp->Totalrows>100?20:6);
$output =""; $hyperlink = new GenerateUrl;
$pgdescs = $page::getPageDesc($settings->Contentpos,$settings->Pagelimit,$paginate->pageOffset(),"ORDER BY Dateposted DESC");
}
/*/initialize classes ends/*/
/*Link image to flex boxes*/
$image_path = $dir_path.PAGEIMG_DIR;
 /*Link image to pages*/
/*Display flex box on page */ 
if($pagecat){
  $template->setPage("Title","{$pagecat->Category}");
  $output .= "<div class=\"flex_box\">";
  $output .="<h3>Latest {$pagecat->Category}</h3><ol>";
  if($pgdescs){ foreach($pgdescs as $pgdesc){
    if(($settings->Contentpos == $pgdesc->Position && $settings->Target == $pagecat->Category) 
      && ($pgdesc->Published=="Y" && $pgdesc->Featured=="Y")){
    $querystr ="id={$pgdesc->Id},action=display,target=".$pagecat->Category.",cpos=".$pagecat->Position."";
    $title_link = $hyperlink::buildLink(".",".","{$pgdesc->Title}",$querystr);
    $continuelink= $hyperlink::buildLink(".",".","[read more &raquo;]",$querystr);
    $output .="<li><h4>{$title_link}</h4>
     <div><p><time class=\"dateposted\">Date Published : ".formatDate($pgdesc->Dateposted,"datetime_word")."</time></p>
     <p>".$Image->showThumbImage($pgdesc->Id,$image_path."thumbnails/").getPageDesc(bbcode_parser($pgdesc->Content),0,400)."<br>{$continuelink}<hr></div></li>";
    }
  }
  $output .= "</ol></div>";
  $output .= $paginate->buildPagination();
  }else{$output ="<h1>Ooops!!! No Information posted Yet</h1>";}
  return $output; 
 } 
} 

/*Display full page */
function mainPageContent(){
/*/initialize classes/*/
global $template,$users,$html;
$settings = new GlobalSettings("pages");
$pgcategory = new GetTableRecord("pagecategory");
$page     = new Page("pages");
$Image = new Image("pageimgs");
//$comments = new Table("comments");
$pagecat = $pgcategory::findRow("Category='$settings->Target'and Position={$settings->Contentpos}");

if($pagecat){
$tp = $settings::countRows();//
$settings->Perpage = 1;
$paginate = new Pagination($settings->Currentpage,$settings->Perpage,$tp->Totalrows);
$paginate->addparam ="action=display,target=".$pagecat->Category.",cpos=".$pagecat->Position."";
$paginate->mid_range = ($tp->Totalrows>100?20:6);
$output =""; 
$getid = $GLOBALS["id"]<>null?"Id=".$GLOBALS["id"]:"";
$getpages = $page::findPage($settings->Perpage,$paginate->pageOffset(),$getid,"ORDER By Id");
}

/*/initialize classes ends/*/
/*Link image to flex boxes*/
 $image_path = PAGEIMG_DIR;
/*Link image to pages*/
//Add Scripts
 $template->setPage("Script",$html->addScript(TEMPLATE_DIR."_scripts/custom.js"));
 if($pagecat){
  $output .= "<div id=\"page\">";//page begins
  $output .= "{$paginate->pageofpage()}";
  if($getpages!=null){ foreach($getpages as $getpage){
  	//Page hits
		$page::$id = $getid?$getid:"Id=".$getpage->Id;//check page id;
		$pagehits  = array_shift(@$page::specificFields(["Views"],$page::$id));
		if($pagehits){
		$pagehit = $pagehits->Views;//current hit or view
		if($pagehits->Views===0){$pagehit = 1;}else{$pagehit++;} 
		$page::$tablefields =array("Views"=>$pagehit);
		$page->save();//store hit in database	
	   }//PAGE HITS END
 $template->setPage("Title","{$getpage->Title}");
 $users::$id = "Id={$getpage->Postedby}";;
 $author = $users::findRow($users::$id);
 $output .="<h1>{$getpage->Title}</h1>";
 		$output .="<div id=\"pagebar\"><p><i>Authored By: ".$author->Firstname." ".$author->Lastname."</i></p>
	 	<datetime class=\"dateposted\">Date Published : ".formatDate($getpage->Dateposted,"datetime_word")."</datetime>
	 	<p>Page Visits:({$pagehit})  Comments:(0) Share this:</p><hr></div>";
	 	if($Image->showFullImage($getpage->Id,$image_path)!=null)
	 	{
	 		$output .="<div class=\"imgholder\">".$Image->showFullImage($getpage->Id,$image_path)."</div>";}
	 		$output .= bbcode_parser($getpage->Content);
			//$setcommentform = commentform($getpage->Id);
		}
  $output .= "</div>";//page ends
  /*/Add Comments Here
  $viewcommentlink = $html->hyperlink("#","", "View Comments","","id=\"viewcommentslink\"");
  $addcommentlink =  $html->hyperlink("#","", "+Add Your Comment","","id=\"addcommentlink\"");
  $output .= "<section id=\"comment_area\">
  {$viewcommentlink} | {$addcommentlink}
   <div id=\"viewcomments\">Some Comments Here</div>
   <div id=\"commentform\">".$setcommentform."</div>
  </section>";
  /*///End comments
  $output .= $paginate->buildPagination();//pagination
  }else{$output ="<h1>Ooops!!! No Information posted Yet</h1>";} 
  return $output;
 }  
} 
/*Display asides> current updates */
function currentUpdates(){
	return null;
}
/*Display asides> current updates ends */

/*Admin dashboard functions*/
function adminAsideMenu(){
global $session,$users;
$user = $users::findRow("Id={$session->userid}");
$dashlinks = new GenerateUrl;
if($session->isLoggedIn() && $session->isAdmin()){
$output = "<p class=\"welcome\">Welcome: {$user->fullName()}<br/>
	 	 <a href=\"../auth/logout.php\">Logout</a></p>";
$output .='<ul class="asideleft_menu"><li><h2>Admin: Options</h2></li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Users", "action=viewusers,target=manageuser").'</li>
      	<li> '.$dashlinks::buildLink(".","dashboard.php","Manage Pages","action=view,target=managepage").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Site" ,"action=view,target=managesite").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Jobs" ,"action=view,target=managejobs").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Businesses" , "action=view,target=managebiz").'</li>
    </ul>';
}elseif($session->isLoggedIn() && $session->isEditor()){
$output = "<p class=\"welcome\">Welcome: {$user->fullName()}<br/>
           <a href=\"../auth/logout.php\">Logout</a></p>";
$output .='<ul class="asideleft_menu"><li><h2>Admin: Options</h2></li>
      	<li> '.$dashlinks::buildLink(".","dashboard.php","Manage Pages","action=view,target=managepage").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Jobs" ,"action=view,target=managejobs").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Businesses" , "action=view,target=managebiz").'</li>
    </ul>';
}else{
$output = "<p class=\"welcome\">Welcome: {$user->fullName()}<br/>
	 	 <a href=\"../auth/logout.php\">Logout</a></p>";
$output .='<ul class="asideleft_menu"><li><h2>Admin: Options</h2></li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Jobs" ,"action=view,target=managejobs").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Businesses" , "action=view,target=managebiz").'</li>
    </ul>';
}
return $output;
}
function adminDashboardMenu(){ global $session,$users;
    
	$dashlinks = new GenerateUrl;
	$user = $users::findRow("Id={$session->userid}");
	if($session->isLoggedIn() && $session->isAdmin()){
	$dashlist = "<h2>Welcome, {$user->userName()}.</h2><ul id=\"dashboard\">";
    $dashlist .='<li><h2>Select a menu to start</h2></li>
      	<li> '.$dashlinks::buildLink(".",".","My Profile", "action=view,target=profile").'</li>
      	<li> '.$dashlinks::buildLink(".","dashboard.php","Manage Users", "action=viewusers,target=manageuser").'</li>
      	<li> '.$dashlinks::buildLink(".","dashboard.php","Manage Pages","action=view,target=managepage").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Jobs" ,"action=view,target=managejobs").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Businesses","action=view,target=managebiz").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Site" , "action=view,target=managesite").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Classifieds &amp; Events" , "action=view,target=ads_n_events").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage News Letters &amp; Mailling List" , "action=view,target=letters_n_maillings").'</li>
        <li> '.$dashlinks::buildLink("..",".","Go to Public Site").'</li>
        <li> '.$dashlinks::buildLink("../auth","logout.php","Logout").'</li></ul>';
	return $dashlist;
  }elseif($session->isLoggedIn()&&$session->isEditor()){
        $dashlist = "<h2>Welcome, {$user->userName()}.</h2><ul id=\"dashboard\">";
        $dashlist .= '<li><h2>Select a menu to start</h2></li>
        <li> '.$dashlinks::buildLink(".",".","My Profile", "action=view,target=profile").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Pages","action=view,target=managepage").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Jobs" ,"action=view,target=managejobs").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Businesses","action=view,target=managebiz").'</li>
        <li> '.$dashlinks::buildLink(".","dashboard.php","Manage News Letters &amp; Mailling List" , "action=view,target=letters_n_maillings").'</li>
        <li> '.$dashlinks::buildLink("..",".","Go to Public Site").'</li>
        <li> '.$dashlinks::buildLink("../auth","logout.php","Logout").'</li></ul>';
	return $dashlist;
  }else{
  	$dashlist = "<h2>Welcome,{$user->userName()}.</h2><ul id=\"dashboard\">";
  	$dashlist .= '<li><h2>Select a menu to start</h2></li>
      	<li> '.$dashlinks::buildLink(".",".","My Profile", "action=view,target=profile").'</li>
       	<li> '.$dashlinks::buildLink(".","dashboard.php","Manage Pages","action=view,target=managepage").'</li>
                <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Jobs" ,"action=view,target=managejobs").'</li>
                <li> '.$dashlinks::buildLink(".","dashboard.php","Manage Businesses","action=view,target=managebiz").'</li>
                <li> '.$dashlinks::buildLink("..",".","Go to Public Site").'</li>
                <li> '.$dashlinks::buildLink("../auth","logout.php","Logout").'</li></ul>';
	return $dashlist;
  }
}

function getAdminNavigation($url=".",$admin_nav=array("profile","pagestats","settings")){
	$index_link = GenerateUrl::buildLink($url,$url, "Dashboard");
	$output = "<ul id=\"admin_nav\">";
	$output .="<li>$index_link</li>";
	foreach ($admin_nav as $navitem) {
	  $make_link = GenerateUrl::buildLink($url, "dashboard.php", ucfirst($navitem),"action=view,target={$navitem}");
	$output .="<li>$make_link</li>";	
	}
	$output .="</ul>";
	return $output;
}
/*upload function 
function uploadImage(){
	global $form,$process,$upload;
	if(isset($GLOBALS["action"])=="editimage"){
 	//$id = $GLOBALS["id"]; 
 	//$editbiz = BusinessDirectory::findById($id);
    }
	 if($process->submitForm()){
	 	
	 }
$form = new Form("Pageform",$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'],"post","enctype=\"multipart/form-data\"");
//Company);
$form->startForm();
$form->setFormField("",
$form->addFormInfo("<h2>Use this to upload..</h2><p>Required Fields are labelled with asterics (*)</p><hr/>"));
//Page Source
$form->setFormField($form->inputLabel("upload", "*Upload Image"),
					$form->inputField("text", "source",$process->post("source")),
					$validate->displayErrorField($process->errorinfo, "source"));
//Submit Form
$form->setFormField(null,
$form->inputField("hidden","pageid",$process->post("pageid")).
$form->inputField("submit", "send","Save"));
$form->endForm();
return $form->DisplayFields($GLOBALS["uploads"],$process->message);

	$output ="<div class=\"uploadform\">";
	$output .="";
	$output .="</div>";
}*/
function pageDetailTable(){
/*/initialize classes/*/
$settings = new GlobalSettings("pages");
$pgcategory = new GetTableRecord("pagecategory");
$page     = new Page("pages");
$tp = $settings::countRows();
$settings->Pagelimit = 10;
$paginate = new Pagination($settings->Currentpage,$settings->Pagelimit,$tp->Totalrows);
$paginate->mid_range = 5;
$paginate->addparam ="action=view,target=managepage";
$output =""; 
$pagecat = $pgcategory::findAllRecords();
$pgdata  = $page::findAllRecords();
/*/initialize classes ends/*/
	  //$$deleted = "Page has been successfully deleted from our database.";
	  //$$success = "Page has been updated successfully";
$hyperlink = new GenerateUrl;	  
 $output .= '<div id="admdetail">
            <h2>Pages Sammary</h2>';
 $output .= '<p style="color: red;"></p>';
 $output .= '<table border="1">
    <tr class="right_align">
    <th colspan="6">'.$hyperlink::buildLink(".",".","+New Page","action=addpage,target=managepage").'</th>
    </tr><tr class="centerit">
    	<th>Page Title</th>
    	<th>Category</th>
    	<th>Featured</th>
    	<th>Published</th>
    	<th>Date Posted</th>
    	<th>Actions</th>
    </tr>';	
if(!empty($pgdata)){foreach($pgdata as $data){
 $output .='<tr class="centerit">
  <td class="left_align">'.$hyperlink::buildLink(".",".","$data->Title","id=$data->Id,cpos=$data->Position,action=display,target=managepage").'</td>';
 foreach ($pagecat as $pcate){
 if($pcate->Position===$data->Position){$output .= '<td class="centerit">'.$pcate->Category.'</td>';}
 }
 $output .='</td>
 <td class="centerit">'.($data->Featured == "Y"?"Yes":"No").'</td>
 <td class="centerit">'.($data->Published == "Y"?"Yes":"No").'</td><td>'.formatDate($data->Dateposted,"date").'</td><td>'.$hyperlink::buildLink(".",".","Edit","id=$data->Id,cpos=$data->Position,action=editpage,target=managepage").'|'.$hyperlink::buildLink(".",".","Delete","id=$data->Id,cpos=$data->Position,action=delete,target=managepage");
}}
 $output .='</tr></table></div>';
 $output .= '<p>'.$paginate->buildPagination().'</p>';
return $output;
}
/*Display preview page */
function previewPage(){
/*/initialize classes/*/
global $template,$target_val,$users;
$settings = new GlobalSettings("pages");
$pgcategory = new GetTableRecord("pagecategory");
$page     = new Page("pages");
$Image = new Image("pageimgs");
//$users = new User("Users");
$pagecat = $pgcategory::findRow("Position={$settings->Contentpos}");
if($pagecat){
$tp = $settings::countRows();
$settings->Perpage = 1;
$paginate = new Pagination($settings->Currentpage,$settings->Perpage,$tp->Totalrows);
$paginate->addparam ="action=display,target=".$target_val["managepage"].",cpos=".$pagecat->Position."";
$paginate->mid_range = ($tp->Totalrows>100?20:6);
$output =""; 
$getid = $GLOBALS["id"]<>null?"Id=".$GLOBALS["id"]:"";
$getpages = $page::findPage($settings->Perpage,$paginate->pageOffset(),$getid,"ORDER By Id");
}
/*/initialize classes ends/*/
/*Link image to flex boxes*/
 $image_path = "../".PAGEIMG_DIR;
/*Link image to pages*/
 if($pagecat){ 
  $output .= "<div id=\"page\">";
  $output .= "{$paginate->pageofpage()}";
  if($getpages!=null){ foreach($getpages as $getpage){
  	 $template->setPage("Title","{$getpage->Title}");
  	 $users::$id = "Id={$getpage->Postedby}";
	 $author = $users::findRow($users::$id);
     $output .="<h1>{$getpage->Title}</h1>";
	 $output .="<p><i>Authored By: ".$author->Firstname." ".$author->Lastname."</i><br>
	 <datetime class=\"dateposted\">Date Published : ".formatDate($getpage->Dateposted,"datetime_word")."</datetime><hr></p>";
	 if($Image->showFullImage($getpage->Id,$image_path)!=null){$output .="<div class=\"imgholder\">".$Image->showFullImage($getpage->Id,$image_path)."</div>";}
	 $output .= bbcode_parser($getpage->Content);
  }
  $output .= "</div>";
  $output .= $paginate->buildPagination();
  }else{$output ="<h1>Ooops!!! No Information posted Yet</h1>";} 
 }else{
     $output ="<h1 class=\"construct\">Ooops!!! Site Under Consturction </h1>";
 		//$output .= $template->pageLoader(array("event"));
 } 
 return $output;
} 
/*Display flex box on page ends */
function navDetailTable(){
/*/initialize classes/*/
global $template;//,$sitemenu
$sitemenu = new GetTableRecord("sitemenu");
$output =""; 
$navdata = $sitemenu::findAllRecords();
//$pgdata  = $page::findAllRecords();
/*/initialize classes ends/*/
	  //$$deleted = "Page has been successfully deleted from our database.";
	  //$$success = "Page has been updated successfully";"<p>".GenerateUrl::buildLink(".","dashboard.php","&laquo;Back to Category Sammary","action=view,target=managesite")."</p>"
$hyperlink = new GenerateUrl;	  
 $output .= '<div id="admdetail">';
 $output .='<h2>Navigation Sammary </h2>';
 $output .= '<p style="color: red;"></p>';
 $output .= '<table border="1">
    <tr class="right_align">
    <th colspan="6">'.$hyperlink::buildLink(".",".","+New Menu","action=addsitenav,target=managesite").'</th>
    </tr><tr class="centerit">
        <th>#Menu ID</th>
        <th>Menu Name</th>
        <th>Position</th>
        <th>Visible</th>
        <th>Actions</th>
    </tr>';	
   if(!empty($navdata)){
       foreach($navdata as $data){
        $output .='<tr class="centerit">';
        $output .='<td>'.$data->Id.'</td>';
        $output .='<td>'.$data->Nav_name.'</td>';
        $output .='<td>'.$data->Position.'</td>';
        $output .='<td>'.($data->Visible == "Y"?"Yes":"No").'</td>';
        $output .='<td>'.$hyperlink::buildLink(".",".","Edit","id=$data->Id,action=editsitenav,target=managesite").
        '|'.$hyperlink::buildLink(".",".","Delete","id=$data->Id,action=delnav,target=managesite").'</td>';
     }
   }
     $output .='</tr></table></div>';
    return $output;
      
}

function cateDetailTable(){
/*/initialize classes/*/
$settings = new GlobalSettings("pages");
$pgcategory = new GetTableRecord("pagecategory");
//$page     = new Page("pages");

$tp = $settings::countRows();
$settings->Pagelimit = 10;
$paginate = new Pagination($settings->Currentpage,$settings->Pagelimit,$tp->Totalrows);
$paginate->mid_range = 5;
$output =""; 
$pagecat = $pgcategory::findAllRecords();
/*/initialize classes ends/*/
	  //$$deleted = "Page has been successfully deleted from our database.";
	  //$$success = "Page has been updated successfully";
$hyperlink = new GenerateUrl;	  
 $output .= '<div id="admdetail"><h2>Category Sammary </h2>';
 $output .= '<p style="color: red;"></p>';
 $output .= '<table border="1">
    <tr class="right_align">
    <th colspan="6">'.$hyperlink::buildLink(".",".","+New Category","action=addpgcate,target=managesite").'</th>
    </tr><tr class="centerit">
    	<th>#Category ID</th>
    	<th>Category Name</th>
    	<th>Position</th>
    	<th>Visible</th>
    	<th>Actions</th>
    </tr>';	
    if(!empty($pagecat)){
        foreach($pagecat as $data){
         $output .='<tr class="centerit">';
         $output .='<td>'.$data->Id.'</td>';
         $output .='<td>'.$data->Category.'</td>';
         $output .='<td>'.$data->Position.'</td>';
         $output .='<td>'.($data->Visible == "Y"?"Yes":"No").'</td>';
         $output .='<td>'.$hyperlink::buildLink(".",".","Edit","id=$data->Id,action=editpgcate,target=managesite").
         '|'.$hyperlink::buildLink(".",".","Delete","id=$data->Id,action=delpgcate,target=managesite").'</td>';
        }
        }
 $output .='</tr></table></div>';
return $output;
}

function usersDetailTable(){
/*/initialize classes/*/
global $users,$target_val; 
$settings = new GlobalSettings("users");
$tp = $settings::countRows();
$settings->Pagelimit = 10;
$paginate = new Pagination($settings->Currentpage,$settings->Pagelimit,$tp->Totalrows);
$paginate->mid_range = 5;
$paginate->addparam ="action=view,target=".$target_val["manageuser"]."";
$output =""; 
$getusers = $users::findAllRecords();
/*/initialize classes ends/*/
	  //$$deleted = "Page has been successfully deleted from our database.";
	  //$$success = "Page has been updated successfully";
$hyperlink = new GenerateUrl;	  
 $output .= '<div id="admdetail">
            <h2>Manage Users Sammary </h2>';
 $output .= '<p style="color: red;"></p>';
 $output .= '<table border="1">
    <tr class="right_align">
    <th colspan="6">'.$hyperlink::buildLink(".",".","+New User","action=adduser,target=manageuser").'</th>
    </tr><tr class="centerit">
    	<th>#User ID</th>
    	<th>FullName</th>
    	<th>Username</th>
    	<th>UserLevel</th>
    	<th>Actions</th>
    </tr>';	
foreach($getusers as $userdata){
 $output .='<tr class="centerit">';
 $output .='<td>'.$userdata->Id.'</td>';
 $output .='<td class="left_align">'.$userdata->fullName().'</td>';
 $output .='<td>'.$userdata->userName().'</td>';
 $output .='<td>'.$userdata->Authlevel.'</td>';
 $output .='<td>'.$hyperlink::buildLink(".",".","Edit","id=$userdata->Id,action=edituser,target=manageuser").
 '|'.$hyperlink::buildLink(".",".","Delete","id=$userdata->Id,action=delete,target=manageuser").'</td>';
 }
 $output .='</tr></table>';
 $output .= $paginate->buildPagination();$output .='</div>';
return $output;
}
/*Admin dashboard functions ends */
function getPublicNavigation($url="."){
/* intialize page navigation  */
  $navigation  = new Navigation(); 
  $navigation  = $navigation::selectNavTable("sitemenu");
  $public_menu = $navigation->findAllRecords("ORDER BY Position");
  $subnav      = $navigation::selectNavTable("submenu");
  $subnav_menu = $subnav::findAllRecords("ORDER BY Id");
  $index_link  = GenerateUrl::buildLink($url,$url,"Home");
 
   if(!empty($public_menu)){
   	$output = "<ul id=\"navigation\"><li>$index_link</li>";
    foreach($public_menu as $pmenu){
      $make_link = GenerateUrl::buildLink($url,".",$pmenu->Nav_name,"action=view,target={$pmenu->Nav_name},cpos={$pmenu->Position},rnd=".random_chars(20));
	  $output .="<li>{$make_link}";
	  /*list for sub navigation starts here */
	  if(!empty($subnav_menu)){
	   	$output .="<ul class=\"subnav\">";
	    foreach($subnav_menu as $smenu){
	   	//submenu list hear
	   	 if(($pmenu->Nav_level === $smenu->Sub_navlevel) && ($pmenu->Id === $smenu->Nav_id)){
	   	 	$msub_link = GenerateUrl::buildLink($url,".",$smenu->Sub_navname,
	 		"action=view,target={$smenu->Sub_navname},cpos={$pmenu->Position},rndchars=".random_chars(20));
			$output .="<li>$msub_link</li>";
	   	  }
	    }
	    $output .="</ul>";
	  }
    } 
    $output .= "</li></ul>"; return $output;
  }   
}
 
 function viewProfile(){
global $users,$session;
//$output .= "<p style=\"color:red; margin-left: 2em;\">" ;
// $$msg ="Your Profile has been successfully updated, thank you.";
//$output .= isset($_GET["msg"])?${$_GET["msg"]}:'' ;
// @$$changepass_msg ="Your password has been successfully changed.";
//$output .= isset($_GET["changepass_msg"])?${$_GET["changepass_msg"]}:'' ;
$u = $users::findRow("Id={$session->userid}");
$authlevel = function($param){
    switch ($param){
              case ADMIN:
                  return "Administrator";
                  break;
              case MODERATOR:
                  return "Moderator";
                  break;
              case EDITOR:
                  return "Editor";
                  break;
              case USER:
                  return "User";
                  break;
              
    }
};
$output = "";
 $editlink = GenerateUrl::buildLink(".","dashboard.php","+Edit Profile","target=profile,action=editregister,id={$u->Id}");
$changepasslink = GenerateUrl::buildLink(".","dashboard.php","Change Password","target=profile,action=changepass,id={$u->Id}");
 $password  = $u->Password?"*********":"";
$gender = $u->Gender=="M"?"Male":"Female";
$output .= <<<"HTML"
<div id="admdetail">
	  <h2>My Profile</h2>
      <table border="1" style="text-align:left;">
        <tr>
          <th colspan="3" style="text-align:center">Personal Information</th>
        </tr>
        <tr>
     	<th colspan="6"><p>{$editlink}</p></th>
        </tr>
        <tr>
          <th scope="row">Fullname:</th>
          <td>{$u->fullName()}</td>
          <td rowspan="2">Upload your picture here</td>
         </tr>
        <tr>
          <th scope="row">Gender:</th>
          <td>{$gender}</td>
        </tr>
        <tr>
          <th colspan="3" style="text-align:center">Login Information</th>
         </tr>
        <tr>
          <th scope="row">Username:</th>
          <td colspan="2">{$u->Username}</td>
        </tr>
        <tr>
          <th scope="row">Email:</th>
          <td colspan="2" >{$u->Email}</td>
        </tr>
        <tr>
          <th scope="row">Password:</th>
          <td>{$password}</td>
          <td>{$changepasslink}</td>
        </tr> 
HTML;

$output .= "<tr><th scope=\"row\">Userlevel:</th>
        <td>".$authlevel($u->Authlevel)."</td>
        <td>&nbsp;</td></tr>
 </table></div>";

return $output;
}
 
 function htmlImage($src,$alt,$width,$height,$optioanl=""){
   $output = "<img src=\"{$src}\" width=\"{$width}\" height=\"{$height}\" ";
   $output .= strlen($optioanl)==0?"/>":"{$optioanl} />";
   echo $output;
   }
