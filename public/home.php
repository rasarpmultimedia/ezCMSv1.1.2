<?php
include_once"includes/initialize.inc.php";
$template = new Template;
//add Scripts to the page
 $template->setPage("Script",$html->addScripts(
 array(TEMPLATE_DIR."_scripts/jquery.js",
 TEMPLATE_DIR."_scripts/tabfunction.js")
 ));
 //Title
$template->setPage("Title","Homepage");
//PageHeader
$template->setPage("PageHeader","<div class=\"adinfo\">
<!--Leaderboard banner here 600x250 (standard)-->
<p class=\"img_rotator\">Google Ads Here</p>
<p>Some Information </p>
</div>");
$template->setPage("MainNav", getPublicNavigation());
//col1
$template->setPage("AsideLeft",'
<div class="livebox">
<!-- Quick Links -->
<h3>Quick Links </h3>
<ul class="quickref">
<li><a href="#">Quick Link 1</a></li>
<li><a href="#">Quick Link 2</a></li>
<li><a href="#">Quick Link 3</a></li>
<li><a href="#">Quick Link 4</a></li>
<li><a href="#">Quick Link 5</a></li>
<li><a href="#">Quick Link 6</a></li>
</ul>
<!-- Quick Links Ends-->
<!-- Current Updates  -->
<h3>Current Information </h3>
<ul class="currentinfo">
<li><p>Some Information form database</p></li>
</ul>
<!-- Quick Links Ends-->
</div>');
//col3
$template->setPage("AsideRight",'
 <!--Tab index Begins here-->
 <div class="tab_wrapper">
 <ul id="tabs">
 <li><a href="#Jobs">News Jobs </a></li>
 <li><a href="#Business">Business Directory</a></li></ul>
 <div id="Jobs" class="tab_content">
  <p><img src="uploads/pageimgs/testimgs/croatia.jpg" alt="croatia" width="100" class="fleximg" />
    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam iaculis vestibulum turpis.</p>
  </div>
  <div id="Business" class="tab_content">
 <p><img src="uploads/pageimgs/testimgs/australia.jpg" alt="australia" width="100" class="fleximg" />
		Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam iaculis vestibulum turpis.</p>
  </div>
 </div>  
 <!--Tab index Ends here-->');
//page contents starts here col2
$content= "<div>Some more information here..</div>".homePageFlexBox();
$template->setPage("Content",$content);
$template->setPage("Footer",PAGE_FOOTER);
include_once TEMPLATE_DIR.SITE_TEMPLATE.LAYOUT;



