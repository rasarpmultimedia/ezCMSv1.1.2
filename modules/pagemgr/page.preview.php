<?php
//include_once"includes/initialize.inc.php";
$template = new Template;
switch ($GLOBALS["action"]) {
    case"display":
	/*Display full page */
   /** PageHeader */
     $template->setPage("PageHeader","");
	 $template->setPage("MainNav",getAdminNavigation());
	/** Aside Left */
    $template->setPage("AsideLeft","");
	/** Aside Right */
    $template->setPage("AsideRight","");
	/** page contents starts here col2 */
    $template->setPage("Content",previewContent());
    $template->setPage("Footer",PAGE_FOOTER);
    include_once TEMPLATE_DIR.SITE_TEMPLATE.LAYOUT;
    break;
default:
     include_once ADMIN_INC_PATH."dashboard.php";    
    break;
 }