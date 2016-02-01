<?php
      $template = new Template;
	  /*Display Page Captions in flexboxes*/ 
      /** PageHeader */
     $template->setPage("PageHeader","<div class=\"adinfo\">
                    <!--Leaderboard banner here 600x250 (standard)-->
                    <p class=\"img_rotator\">Google Ads Here</p>
                    <p>Some Information </p></div>");
    $template->setPage("MainNav", getPublicNavigation());
	/** Aside Left */
    $template->setPage("AsideLeft",'
                    <div class="livebox"><h3>Current Information </h3>
                    <ul class="currentinfo">
                    <li><p>Some Information form database</p></li>
                    </ul><!-- Quick Links Ends--></div>');
	/** Aside Right */
     $template->setPage("AsideRight",'');
	/** page contents starts here col2 */
     $content ="";
     $template->setPage("Content",$content);
	$template->setPage("Footer",PAGE_FOOTER);
	include_once TEMPLATE_DIR.SITE_TEMPLATE.LAYOUT;
?>