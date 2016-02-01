<?php
/*
 * This are defined paths to all main directories in the PowerCMS (PCMS) Framework 
 * Coder: Abdul-Rahman Sarpong
 * (c) Rasarp Multimedia Systems 
 * */
//(defined("PCMS"))?null:define("PCMS", "pcms_");
defined("DS")?null:define("DS","/");
//defined("SITE")?null:define("SITE","powercms");//change this to you website domain name;
//defined("SITE_ROOT")?null:define("SITE_ROOT","");
defined("DATA_PATH") 	 ?null:define("DATA_PATH",     "data".DS);
defined("LIB_PATH") 	 ?null:define("LIB_PATH",	   "library".DS);
defined("INC_PATH") 	 ?null:define("INC_PATH", 	   "includes".DS);
defined("ADMIN_INC_PATH")?null:define("ADMIN_INC_PATH","admin".DS);
defined("CONFIG_PATH") 	 ?null:define("CONFIG_PATH",   "config".DS);
defined("MODULES_DIR")   ?null:define("MODULES_DIR",   "modules".DS);
defined("PUBLIC_DIR")    ?null:define("PUBLIC_DIR",    "public".DS);
//defined("WEBROOT")    ?null:define("WEBROOT",    "webroot".DS);
defined("AUTH_DIR")      ?null:define("AUTH_DIR",  	   "auth".DS);
defined("USERS_DIR")     ?null:define("USERS_DIR",     "uaccount".DS);
/* Define basic template */
/*Define site specific directories */

/*Site Directories Paths*/
defined("ADMIN_DIR")	?null:define("ADMIN_DIR", 	"admin".DS);
defined("TEMPLATE_DIR")	?null:define("TEMPLATE_DIR","templates".DS);
//defined("PAGES_DIR")	?null:define("PAGES_DIR",	"pages".DS);

/*Upload directories*/
defined("UPLOAD_DIR")   ?null:define("UPLOAD_DIR",	"uploads".DS);
defined("TEMP_DIR")		?null:define("TEMP_DIR",	UPLOAD_DIR."temp".DS);
defined("PAGEIMG_DIR")	?null:define("PAGEIMG_DIR", UPLOAD_DIR."pageimgs".DS);
defined("DOC_DIR") 		?null:define("DOC_DIR", 	UPLOAD_DIR."docs".DS);
defined("PROFILE_IMG")  ?null:define("PROFILE_IMG", UPLOAD_DIR."profileimgs".DS);
