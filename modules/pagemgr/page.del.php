<?php
function delPage(){
       //Delete
 if($GLOBALS["action"]=="delete"&& $GLOBALS["id"]!=null){
		global $database;
		$delpage = new Page("pages");
		$id = $delpage::$id="Id=".$GLOBALS["id"];
		$delpage->delete();
		if($database->affectedRows()){
		//delete corresponding image
		   $imgdirpath ="../";
		   $image_path= $imgdirpath.PAGEIMG_DIR;
		   $delimage = new Image("pageimgs");
		   $getimage = $delimage::findRow("Pageid='{$GLOBALS["id"]}'");
		   if($database->getNumofRows()>0){
		   	unlink($image_path.$getimage->Imgname.".".$getimage->Extention);//delete image
			unlink($imgdirpath.TEMP_DIR.$getimage->Imgname.".".$getimage->Extention);//delete thumb image
			$delimage::$id="Id=".$GLOBALS["id"];
			$delimage->delete();
		   }
		}
 }
    header("Location: ".filter_var($_SERVER['PHP_SELF']."?action=view&target=managepage"));
}
?>