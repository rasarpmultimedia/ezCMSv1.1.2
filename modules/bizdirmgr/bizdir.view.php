<?php
require_once"bizdir.form.php";
//include_once"../../includes/initialize.inc.php";
/*recieve qureystrings*/
switch ($GLOBALS["action"]){
	case "display":
	    $template->setPage("Title","Business dirctory Preview");
	    $content="<p>Display full page here :) :)</p>";
		$template->setPage("Content",$content);
        $template->setPage("MainNav",getAdminNavigation());
	break;
    case "addbiz":
		 $template->setPage("Title","Business Directory Registeration Form");
         $template->setPage("MainNav",getAdminNavigation());
		 $template->setPage("Content", businessdirform());
		break;
	case "editbiz":
		 $template->setPage("Title","Edit-Business Directory Registeration Form");
         $template->setPage("MainNav",getAdminNavigation());
		 $template->setPage("Content", businessdirform());
		break;
	case 'view':
		$template->setPage("Title","Preview::Business Directory ");
        $content ="<p>Some information on business directory management viewer</p>";
		$template->setPage("Content",$content);
        $template->setPage("MainNav",getAdminNavigation());
		break;
	default:	    
	    $template->setPage("Title","Business Directory ");
	    $content="<p>Some information on business directory management</p>";
		$template->setPage("Content",$content);
        $template->setPage("MainNav",getAdminNavigation());
	break;
}
$template->setPage("Footer",ADMIN_FOOTER);
include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;