<!DOCTYPE html>
<html lang="en">
<head >
<meta charset="utf-8">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="author" content="Rasarp Multimedia Systems - Ghana" />
<meta name="viewport" content="width=device-width; initial-scale=1.0" />
<link rel="stylesheet" media="screen,projection" href="../templates/pine_theme/_css/main.css" />
<link rel="stylesheet" media="screen,projection" href="../templates/pine_theme/_css/bootstrap.min.css" />
<!--[if IE]>
<link href="../templates/stylesheets/default/ie5+.css" rel="stylesheet" type="text/css">
<![endif]-->
<!--<script src="../templates/_scripts/jquery.js"> </script>-->
<title><?php echo $template->getPage("Title")?></title>
</head>
<body>
<div id="wrapper">
<!--// CONTENT HEADER //-->

<div id="header" class="col-md-12">
<div id="logo"><!--logo-->
<img src="../templates/pine_theme/_images/logo.png" alt="Logo" width="10" height="110"/>
</div>
<?php echo $template->getPage("PageHeader") ?>
</div>

<!--//MENU OR NAV AREA//-->
<!--//SIDE BAR AREA //-->
<div id="aside_left" class="col-md-5"><?php  echo $template->getPage("AsideLeft") ?></div>
<div id="aside_right" class="col-md-1"><?php echo $template->getPage("AsideRight")?></div>
<!--//SIDE BAR AREA //-->
<!--// CONTENT AREA STARTS//-->
<div id="content" class="col-md-6">
	<?php echo $template->getPage("Content") ?>
</div>
<!--// CONTENT AREA ENDS//-->
<!--//FOOTER AREA //-->
<div id="footer">
	<?php echo $template->getPage("Footer") ?>
</div>
</div>
<?php echo $template->getPage("Script"); ?>
</body>
</html>