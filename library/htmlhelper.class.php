<?php
class HtmlHelper{
    public static $data = array();
	public function addElement($tag,$content=null,$extra_attr=''){
		$tag = $content!=null?"<{$tag} {$extra_attr}>{$content}</{$tag}>":"<{$tag}/>";
		return $tag;
    }
    public function ul(array$items,$extra_attr=''){
		$puts = "<ul {$extra_attr}>";
		foreach ($items as $item) {
		$puts .= "<li>{$item}</li>";	
		}
		$puts .= "</ul>";
		return $puts;
	}
    public function ol(array$items,$extra_attr=''){
		$puts = "<ol {$extra_attr}>";
		foreach ($items as $item) {
		$puts .= "<li>{$item}</li>";	
		}
		$puts .= "</ol>";
		return $puts;
	}
    public function table(array$tabledata,$attr="",$cssrule=""){
            foreach ($tabledata as $k => $value) {
               if($k==="th"){
                   $output .="<th {$cssrule}>{$value}</th>";
               }  elseif($k==="td") {
                   $output .="<td {$cssrule}>{$value}</td>";
               }   
            }
            $table="<table $attr>".$output."</table>";
            return $table;
        }
    public function hyperlink($url, $addfile, $linktext,$params='',$id=''){
         return GenerateUrl::buildLink($url, $addfile, $linktext,$params,$id);
    }
    public function addCSS($href,$rel="stylesheet",$media="screen"){
   	return "<link rel=\"{$rel}\" media=\"{$media}\" href=\"{$href}\" />";
   }
	public function addScript($src){
    //header("Content-type: text/javascript");
   	return "<script src=\"{$src}\" type=\"text/javascript\"></script>";
   }
  public function addScripts(array$srcs){
  	 //array_push($srcs);
	 $puts ="";foreach($srcs as $src){
	 $puts .=  "<script src=\"{$src}\" type=\"text/javascript\"></script>\n";
	}
   	return $puts;
   }
}
$html = new HtmlHelper;
?>