<?php
include_once"../includes/admin_init.php";
//login to access this page
switch($GLOBALS["target"]){
    case $target_val["settings"]:
        $content = "Some page settings here";
        $template->setPage("Content", $content);
        $template->setPage("AsideLeft",adminAsideMenu());
        $template->setPage("MainNav",getAdminNavigation());
        include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;
        break;
    case $target_val["managesite"]:
        include_once "../".MODULES_DIR."sitemgr/site.view.php";
        break;
    case $target_val["manageuser"]:
        include_once "../".MODULES_DIR."uaccount/profile.view.php";
        break;
    case $target_val["uaccount"]:
        include_once "../".MODULES_DIR."uaccount/profile.view.php";
        break;
	case $target_val["managejobs"]:
        include_once "../".MODULES_DIR."jobmgr/job.view.php";
        break;
    case $target_val["managebiz"]:
        include_once "../".MODULES_DIR."bizdirmgr/bizdir.view.php";
        break;
    case $target_val["managepage"]:
        include_once "../".MODULES_DIR."pagemgr/page.view.php";
        break;
    case $target_val["pagestats"]:	
        $template->setPage("Title", "Admin::Page Stats");
        $template->setPage("MainNav",getAdminNavigation());
        //$template->setPage("AsideLeft",adminAsideMenu());
        $content = "Some page stats here";
        $template->setPage("Content", $content);
        $template->setPage("Footer",ADMIN_FOOTER);
        include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;
        break;
    default:
        $template->setPage("Title", "Admin Dashboard");
        $template->setPage("Content",adminDashboardMenu());
        $template->setPage("Footer",ADMIN_FOOTER);
        include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;
        break;
}

