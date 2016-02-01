<?php 
 include_once"../includes/admin_init.php";
   if($session->isLoggedIn()){
   	    $session->logOut();
        redirectTo("../auth/login.php");
   }
   
?>