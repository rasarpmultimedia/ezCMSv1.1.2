<?php
require_once"page.form.php";
require_once"page.del.php";
switch ($GLOBALS["action"]){
case "display":
	    			$template->setPage("Title","Page Preview");
	   				//$content="<p>Display full page here :) :)</p>";
                    $template->setPage("Content",previewPage());
                    $template->setPage("MainNav",getAdminNavigation());
break;
case "addpage":
                    $template->setPage("Script",$html->addScripts(array(
                    "../".TEMPLATE_DIR."_scripts/ckeditor/ckeditor.js",
                    "../".TEMPLATE_DIR."_scripts/ckeditor/style.js"
					)));//loads editor script
                    $template->setPage("Title","Add-New Page Form");
                    $template->setPage("MainNav",getAdminNavigation());
                    $template->setPage("Content",pageform());
break;
case "editpage":
                    
                    $template->setPage("Script",$html->addScripts(array(
                    "../".TEMPLATE_DIR."_scripts/ckeditor/ckeditor.js",
                    "../".TEMPLATE_DIR."_scripts/ckeditor/style.js"
					)));//loads editor script
                    $template->setPage("Title","Edit-Page Form");
                    $template->setPage("MainNav",getAdminNavigation());
                    $template->setPage("Content",pageform());
break;
case "delete":
        echo delPage();	
break;
case "view":
                    $template->setPage("Title","Page Details");
                    $content = pageDetailTable();
                    $template->setPage("Content",$content);
                    $template->setPage("MainNav",getAdminNavigation());
break;
default:	    
	    $template->setPage("Title","Page-Manager");
	    $content="<p>Some information on page management</p>";
                    $template->setPage("Content",$content);
                    $template->setPage("MainNav",getAdminNavigation());
break;
}
                    $template->setPage("AsideLeft",adminAsideMenu());
					$template->setPage("Footer",ADMIN_FOOTER);
					include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;
			