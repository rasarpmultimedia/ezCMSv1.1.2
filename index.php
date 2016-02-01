<?php
include_once"includes/initialize.inc.php";
//echo $_SERVER["REQUEST_URI"];
$pagename_arr =  $GLOBALS["pagenames"];
 $target = strtolower($GLOBALS["target"]);
	  	if(in_array( $target,$pagename_arr)){
		  $template->loadPage($pagename_arr,PUBLIC_DIR); 
		}  else {
			include_once PUBLIC_DIR."viewpage.php";
		}
?>
