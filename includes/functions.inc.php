<?php
/*
 * This script contains optional functions that are needed in some parts 
 * of an application.
 * Written By Abdul-Rahman Sarpong (c)
*/
 
 function debug($debug_var){
 	echo "<pre id='debug'>";
	       var_dump($debug_var);
	echo "</pre>";
 }
 
function getPageDesc($str, $start_at=0,$end_at=60){
	      $subchar = substr($str, $start_at,$end_at);
		  return $subchar."...";
}

function checkObj($obj){
	   $obj = is_object($obj)?$obj:null;
	   return $obj;
}

 function redirectTo($url = null){
 	  if($url <>null){
 	 	header("Location: {$url}");
	  }
 }
 /*This function sends an email*/
 function mailTo($to,$subject,$message,$add_header='',$add_param =''){
	            mail($to,$subject,$message,$add_header,$add_param);
 }
/* This check if a particular year is a leap year */
function is_leap_year($year){
	  $year = date('Y');
	  //$year = (int) $year;
	  return((($year % 4) == 0) &&((($year % 100)!=0)||(($year % 400)==0)));
	}

function get_days_in_month($month,$year){
	 $month = (int) $month;
	 $year  = (int) $year;
	 return ($month == 2 ? ($year % 4 ? 28 :($year % 100 ? 29:($year % 400?28:29))):(($month - 1)%7%2?30:31));
	 }
//echo get_days_in_month('2','2000');
 
/**
	 This function trims, check for magic quotes and add the approprates
	 add slashes to secure mysql injection
*/
function secure_dbase_str($dbstr){
	       if($dbstr){
			   $dbstr = trim($dbstr);
			   if(!get_magic_quotes_gpc()){
			   	 $dbstr = remove_db_slashes($dbstr);// strips 
				 $dbstr = mysql_real_escape_string($dbstr);
			   }else{$dbstr = addslashes($dbstr);}
		   }
	  return $dbstr;
	}

function remove_db_slashes($dbstring){
	  if(get_magic_quotes_gpc()){
	 	$dbstring = stripcslashes($dbstring);
	  }
	 return $dbstring;
    }

function get_file_extension($string){
		$string = strtolower($string);
	 	 $dotpos = strrpos($string,".");
	  	 if(!$dotpos) return "";
	    	$strlen = strlen($string) - $dotpos;
			$extension = substr($string,$dotpos+1,$strlen);
		 return $extension;
}
//echo get_image_extension("theman.gif");
//Extract Image Name
function get_image_name($string){
    $string = strtolower($string);
    list($filename) = explode(".", $string);
    return $filename;
}

function getFilename($string,$seperator){
	 $string = strtolower($string);
    list($name) = explode("$seperator", $string);
    return $name;
	 }
 
function random_chars($length,$randmin=0){
	 $characters ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	 $randchar ="";
	 for($i=0;$i<$length;$i++){
		 $randchar .= $characters[mt_rand($randmin,strlen($characters)-1)];
		 }
		return $randchar;
	}
//echo random_chars(10,1);

/**
 * Date Format Function
//echo date("jS F Y",strtotime(formatDate("2011-06-30","mysqldate")));
//echo "<br /> \n".formatDate("2011-06-30","mysqldate")
 * */
function formatDate($origdate='',$format = "%d/%m/%Y"){
	switch($format){
	case "date"			: $format = "%d-%m-%Y";
	break;
	case "datetime"		: $format = "%d-%m-%Y %H:%M:%S";
	break;
	case "mysqldate"	: $format = "%Y-%m-%d";
	break;
	case "mysqldatetime": $format = "%Y-%m-%d %H:%M:%S";
	break; 
	case "datetime_ampm": $format = "%d-%m-%Y at %I:%M:%S %p";
	break; 
	case "datetime_word": $format = "%a, %B %d, %Y at %I:%M:%S%p";
	default: $format;
	}
	if(strlen($origdate)>0){
		return strftime($format,strtotime($origdate));
	}else{ return " "; }
}

/**
	This BB Code parses formated HTML tags back to its
	original state
*/
function bbcode_parser($string){
	$string = trim($string);
	$html_tags ='p|b|i|h1|h2|h3|h4|h5|h6|size|color|center|quote|cite|url|img';
	while(preg_match_all('`\[('.$html_tags.')=?(.*?)\](.+?)\[/\1\]`',$string,$matches)) foreach($matches[0] as $key => $match){
		 list($tags,$parameter ,$innertext) = array($matches[1][$key],$matches[2][$key],$matches[3][$key]);
		 switch($tags){
		 case "p" : $replacement = "<p> $innertext </p>";  break;
		 case "b" : $replacement = "<strong> $innertext </strong>"; break;
		 case "i" : $replacement = "<i> $innertext </i>"; break;
		 case "h1": $replacement = "<h1> $innertext </h1>"; break;
		 case "h2": $replacement = "<h2> $innertext </h2>"; break;
		 case "h3": $replacement = "<h3> $innertext </h3>"; break;
		 case "h4": $replacement = "<h4> $innertext </h4>"; break;
		 case "h5": $replacement = "<h5> $innertext </h5>"; break;
		 case "h6": $replacement = "<h6> $innertext </h6>"; break;
		 case "hr": $replacement = "<hr />";
		 case "size"  : $replacement = "<span style=\"font-size:$parameter;\">$innertext</span>"; break;
		 case "color" : $replacement = "<span style=\"color : $parameter;\">$innertext</span>"; break;
		 case "center": $replacement = "<span class=\"centered;\">$innertext</span>"; break;
		 case "quote" : $replacement = "<blockquote>$innertext</blockquote>";/**/ break;
		 case "cite":	$replacement = "<cite>$innertext</cite>"; break;
		 case "url" :	$replacement = "<a href=\"".($parameter ? $parameter : $innertext)."\">$innertext</a>"; break;
		 case "img" : list($width,$height) = preg_split("`[Xx]`",$parameter);
		 $replacement = "<img src =\"".$innertext."\" ".(is_numeric($width)? "width =\"$width\"":"")." ".(is_numeric($height)?"height=\"$height\"":"").">"; break;
			 }
		   $string = str_replace($match, $replacement, $string);
		 }
		 return $string;
	}
//echo bbcode_parser("[p][b]this is testing bb code paser[/b][/p]");

?>