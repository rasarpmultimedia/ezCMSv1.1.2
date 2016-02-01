<?php
function delUser(){
    if($GLOBALS["action"]=="delete"&& $GLOBALS["id"]!=null){
            global $database,$users;
            $deluser = $users;
			$deluser::$id = isset($GLOBALS["id"])?"Id=".$GLOBALS["id"]:null;
            $deluser->delete();
            header("Location: ../admin/?action=viewusers&target=manageuser");
    }	
}
?>