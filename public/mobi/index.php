<?php
include_once"../pcms_includes/initialize.inc.php";
 $template->_set("Meta_Keywords", "News, Blogs, Lifesyle etc");
 $template->_set("Meta_Description", "Provided news contents etc");
 $template->_set("Title_Region", "Where page title goes:::test page");
 $template->_set("Image_Ads_Region", "Some Image Ads here");
 $template->_set("Sub_Header_Region", "Place some heading or adverts here");
 $template->_set("Horizontal_Nav_Region", "Page navigaation goes here");
 $template->_set("Big_Banner_Region", "Some Ads banner from google goes here");
 $template->_set("Aside_Left_Region", "Some more important information goes here");
 $template->_set("Aside_Right_Region", "Some more important ads and information goes here");
 $template->_set("Main_Content_Region", "Main information on the site   goes here");
 $template->_set("Footer_Region", "Some more important footer information goes here");
 $template->display("../".TEMPLATE_DIR.SITE_TEMPLATE."/_html/mobi_layout.tpl.htm");
