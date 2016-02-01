<?php
include_once"../includes/admin_init.php";
include_once "../".MODULES_DIR.USERS_DIR."register.form.php";
$template->setPage("Title","User Registeration");
$template->setPage("Content",register());
$template->setPage("Footer",ADMIN_FOOTER);
include_once "../".TEMPLATE_DIR.SITE_TEMPLATE.ADMIN_LAYOUT;