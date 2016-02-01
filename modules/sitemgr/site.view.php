<?php
require_once"site.form.php";
require_once"site.del.php";
/*  */
switch ($GLOBALS["action"]){
    case "addsitenav":
        $template->setPage("Title","Add-Site Navigation ");
        $template->setPage("MainNav",getAdminNavigation());
        $template->setPage("Content",siteNavForm());
        break;
    case "editsitenav":
        $template->setPage("Title","Edit-Site Navigation ");
        $template->setPage("MainNav",getAdminNavigation());
        $template->setPage("Content",siteNavForm());
        break;
    case "delnav":
		//Delete
           echo delNavManu();
        break;
    case "addpgcate":
        $template->setPage("Title","Add-Page Category ");
        $template->setPage("MainNav", getAdminNavigation());
        $template->setPage("Content", categoryForm());
        break;
    case "editpgcate":
        $template->setPage("Title","Edit-Page Category");
        $template->setPage("MainNav", getAdminNavigation());
        $template->setPage("Content", categoryForm());
        break; 
    case "delpgcate":
		//delete
         echo delPageCate();	
        break;
    case "view":
        $template->setPage("Title","Preview Navigation and Page Category");
        $content =navDetailTable()."<hr>".cateDetailTable();
        $template->setPage("Content",$content);
        $template->setPage("MainNav",getAdminNavigation());
        break;
    default:
        $template->setPage("Title","Site-Manager");
        $content =navDetailTable()."<hr>".cateDetailTable();// $content="<p>Some information on site management</p>";
        $template->setPage("Content",$content);
        $template->setPage("MainNav",getAdminNavigation());
        break;
}
        $template->setPage("AsideLeft",adminAsideMenu());
        $template->setPage("Footer",ADMIN_FOOTER);
        include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;