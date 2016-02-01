<?php
//Site Directory Definitions
$path="../";
include "dir_paths.inc.php";

//Load Core Database Classes
require_once $path.CONFIG_PATH . "dbconstants.php";
require_once $path.CONFIG_PATH . "dbcon.class.php";
require_once $path.CONFIG_PATH . "dbobjects.class.php";
require_once $path.CONFIG_PATH . "table.class.php";
//Load Database Data Classes
require_once $path.DATA_PATH . "settings.data.php";
require_once $path.DATA_PATH . "navigation.data.php";
//require_once $path.DATA_PATH . "businessdir.data.php";
require_once $path.DATA_PATH . "user.data.php";
require_once $path.DATA_PATH . "page.data.php";
//require_once DATA_PATH . "job.data.php";
//require_once DATA_PATH . "site_template.data.php";
require_once $path.DATA_PATH . "images.data.php";
//Load Core functions and Classes
require_once $path.LIB_PATH . "session.class.php";
require_once $path.INC_PATH . "global_settings.inc.php";
require_once $path.INC_PATH . "functions.inc.php";
require_once $path.INC_PATH . "html_func.inc.php";
//Load Main Classes
require_once $path.LIB_PATH . "dirnfiles.class.php";
require_once $path.LIB_PATH . "template.class.php";
require_once $path.LIB_PATH . "thumbnail.class.php";
require_once $path.LIB_PATH . "gen_url.class.php";
require_once $path.LIB_PATH . "htmlhelper.class.php";
require_once $path.LIB_PATH . "upload.class.php";
//Load Form Class
require_once $path.LIB_PATH . "form.class.php";
//Load Pagination Class
require_once $path.LIB_PATH . "pagination.class.php";
