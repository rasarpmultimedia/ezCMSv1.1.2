<?php
include_once"../includes/admin_init.php";
 if(!$session->isLoggedIn()){
    redirectTo("../auth/login.php");
 }else{
  include_once "admin.view.php";	
 }


