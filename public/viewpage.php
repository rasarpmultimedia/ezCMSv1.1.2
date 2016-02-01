<?php
$template = new Template;
 switch ($GLOBALS["action"]) {
 	case"resource":
 	//resource code later
 	break;
 	case"view":
	  /*Display Page Captions in flexboxes*/ 
      /** PageHeader */
     $template->setPage("PageHeader","<div class=\"adinfo\">
	                    <!--Leaderboard banner here 600x250 (standard)-->
	                    <p class=\"img_rotator\">Google Ads Here</p>
	                    <p>Some Information </p></div>");
	 $template->setPage("MainNav", getPublicNavigation());
	/** Aside Left */
    $template->setPage("AsideLeft",'
	                    <div class="livebox"><h3>Current Information </h3>
	                    <ul class="currentinfo">
	                    <li><p>Some Information form database</p></li>
	                    </ul><!-- Quick Links Ends--></div>');
	/** Aside Right */
	$template->setPage("AsideRight",'');
	/** page contents starts here col2 */
     $template->setPage("Content",pageFlexBox());
	$template->setPage("Footer",PAGE_FOOTER);
	include_once TEMPLATE_DIR.SITE_TEMPLATE.LAYOUT;
	break;
	case"display":
	/*Display full page */
      /** PageHeader */
     $template->setPage("PageHeader","<div class=\"adinfo\">
                        <!--Leaderboard banner here 600x250 (standard)-->
                        <p class=\"img_rotator\">Google Ads Here</p>
                        <p>Some Information </p></div>");
     $template->setPage("MainNav", getPublicNavigation());
	/** Aside Left */
    $template->setPage("AsideLeft","
                        <div class=\"livebox\">
                        <h3>Current Information </h3>
                        <ul class=\"currentinfo\">
                        <li><p>Some Information form database</p></li>
                        </ul><!-- Quick Links Ends--></div>");
	/** Aside Right */
	$template->setPage("AsideRight","");
	/** page contents starts here col2 */
	
	$content=mainPageContent(); //"Full page contents here.... :) more from database.....:) :D";
	$template->setPage("Content",$content);
	$template->setPage("Footer",PAGE_FOOTER);
	include_once TEMPLATE_DIR.SITE_TEMPLATE.LAYOUT;
	break;
    default:
     include_once PUBLIC_DIR."home.php";    
    break;
}   
