<?php
/* Querystring Settings*/
 $GLOBALS["action"] = isset($_GET["action"])?strval($_GET["action"]):"";
 $GLOBALS["target"] = isset($_GET["target"])?strval($_GET["target"]):"";
 $GLOBALS["id"]       = isset($_GET["id"])    ?intval($_GET["id"]):null;
 $GLOBALS["currentpage"] = isset($_GET["page"])  ?intval($_GET["page"]):1;
 $GLOBALS["contentpos"]  = isset($_GET["cpos"])  ?intval($_GET["cpos"]):1;
 $GLOBALS["success"]       = isset($_GET["success"])?strval($_GET["success"]):"";
 $GLOBALS["deleted"]        = isset($_GET["deleted"])?strval($_GET["deleted"]):"";  
 /*
  * Page Include Settings fo main website (public didrectory);
  */
  $pagenames = array("events");
 /*Admin Dashboard Querystrings*/
 $target_val = array(
  "settings"=>"settings",
  "managesite"=>"managesite",
  "pagestats"=>"pagestats",
  "uaccount"=>"profile",
  "managebiz"=>"managebiz",
  "manageuser"=>"manageuser",
  "managepage"=>"managepage",
  "managejobs"=>"managejobs",
  "managebiz"=>"managebiz"
 );

/*User Access Levels constants */
(defined("ADMIN")) 	  ?null:define("ADMIN",  	1);
(defined("MODERATOR"))?null:define("MODERATOR", 2);
(defined("EDITOR"))   ?null:define("EDITOR", 	3);
(defined("USER"))     ?null:define("USER" ,  	4);

/*Set Page layout constants */
(defined("SITE_TEMPLATE"))?null:define("SITE_TEMPLATE" , "blue_ice");
(defined("LAYOUT")) ?null:define("LAYOUT" , "/_html/layout.inc.php");
(defined("ADMIN_LAYOUT")) ?null:define("ADMIN_LAYOUT" , "/_html/adm_layout.inc.php");
(defined("PAGE_FOOTER"))  ?null:define("PAGE_FOOTER" , "<p class=\"footer_text\">&copy; Rasarp Multimedia Systems and PowerCMS&trade; - ".date("Y",time())."</p>");
(defined("ADMIN_FOOTER")) ?null:define("ADMIN_FOOTER" , "<p class=\"footer_text\">&copy; Rasarp Multimedia Systems and PowerCMS&trade; - ".date("Y",time())."</p>");
 
/*/
 * General Form Settings Values = {Top Labling}, {Left Labling}, {Group Labling}
/*/
$form_labling = "Top Labling";
//include_once"site_dir_paths.inc.php";