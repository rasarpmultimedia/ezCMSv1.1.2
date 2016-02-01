<?php
include_once"profile.form.php";
include_once"changepass.form.php";
$template->setPage("MainNav",getAdminNavigation());
$template->setPage("AsideLeft",adminAsideMenu());//comment this code if the login area is ready
switch ($GLOBALS["action"]){
    case "register":
        $template->setPage("Title","User Registeration");
        $template->setPage("Content", userProfileForm());
        break;
    case "editregister":
            $template->setPage("Title","User Edit-Registeration");
            $template->setPage("Content", userProfileForm());
            break;
   case "adduser":
            $template->setPage("Title","Add-AdminUser::Registeration");
            $template->setPage("Content", userProfileForm(true));
            break;
   case "edituser":
            $template->setPage("Title","Edit-AdminUser::Registeration");
            $template->setPage("Content", userProfileForm(true));
            break;
   case "viewusers":
            $template->setPage("Title","Preview::AdminUsers ");
            //$content ="<p>Some information on user profile viewer (Table list of Admin.)</p>";//
            $template->setPage("Content",  usersDetailTable());
            break;
   case "profile":
            $template->setPage("Title", "Preview::Profile");
            //$content ="<p>Some information on user profile viewer (Table list of Admin.)</p>";
            $template->setPage("Content",$content);
            break;
   case "delete":
            echo delUser();
            header("Location: index.php");
            break;
   case "changepass":
        $template->setPage("Title","Change My Password");
        $template->setPage("Content", changePassword());
        break;
   default:
            $template->setPage("Title", "My Profile ");
            $template->setPage("Content",viewProfile());
            break;
}
$template->setPage("Footer",ADMIN_FOOTER);
include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;