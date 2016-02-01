<?php
function delNavManu(){
    if($GLOBALS["action"]=="delnav"&& $GLOBALS["id"]!=null){
            global $database;
            $menudata = new Table("sitemenu");
			$menudata::$id = isset($GLOBALS["id"])?"Id=".$GLOBALS["id"]:null;
            $menudata->delete();
            header("Location: ../admin/?action=view&target=managesite");
    }	
}
/*This function deletes Page Category Details */
function delPageCate(){
    if($GLOBALS["action"]=="delpgcate"&& $GLOBALS["id"]!=null){
            global $database;
            $catedata = new Table("pagecategory");
			$catedata::$id = isset($GLOBALS["id"])?"Id=".$GLOBALS["id"]:null;
            $catedata->delete();
            header("Location: ../admin/?action=view&target=managesite");
    }	
}
?>