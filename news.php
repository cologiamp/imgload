<?php 
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1250799957 - Thursday, August 20, 2009, 04:25:57 PM EDT -0400
	// ======================================== /
	
	require_once "./source/includes/data.php";
	require_once "{$mmhclass->info->root_path}source/language/home.php";
	require("conexion.php");
	require("siteinfo.php");

	session_start();
	$microtime = $_SESSION["microtime"];
	
	
	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);
	
	$mmhclass->templ->templ_vars[] = array(
		"BASE_URL" => $mmhclass->info->base_url,
		"SITE_NAME" => $mmhclass->info->config['site_name'],
	);
	$mmhclass->templ->templ_vars[] = array(
		"FILE_EXTENSIONS" => $file_extensions,
		"SITE_NAME" => $mmhclass->info->config['site_name'],
		"MAX_RESULTS" => $mmhclass->info->config['max_results'],
		"MAX_FILESIZE" => $mmhclass->image->format_filesize($mmhclass->info->config['max_filesize']),
		"BOXED_UPLOAD_YES" => (($mmhclass->info->user_data['upload_type'] == "boxed") ? "checked=\"checked\"" : NULL),
		"STANDARD_UPLOAD_YES" => (($mmhclass->info->user_data['upload_type'] == "standard" || $mmhclass->info->is_user == false) ? "checked=\"checked\"" : NULL),
	);
	//$mmhclass->templ->output("home", "flash_page");
	
	
	/*
	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);
	
	$mmhclass->templ->templ_vars[] = array(
		"BASE_URL" => $mmhclass->info->base_url,
		"SITE_NAME" => $mmhclass->info->config['site_name'],
	);
	*/
	$mmhclass->templ->templ_vars[] = array(
				   	"USER_ID" => $mmhclass->info->user_data['user_id'],
				   	"USERNAME" => $mmhclass->info->user_data['username'],
				   	"IP_ADDRESS" => $mmhclass->info->user_data['ip_address'],
				   	"EMAIL_ADDRESS" => $mmhclass->info->user_data['email_address'],
					"PAYPAL_ADDRESS" => $mmhclass->info->user_data['paypal_address'],
					"PAYZA_ADDRESS" => $mmhclass->info->user_data['payza_address'],
					"REALBALANCE" => $mmhclass->info->user_data['realbalance'],
					"PAYEDBALANCE" => $mmhclass->info->user_data['payedbalance'],
					"IP_HOSTNAME" => gethostbyaddr($mmhclass->info->user_data['ip_address']),
				   	"TIME_JOINED" => date($mmhclass->info->config['date_format'], $mmhclass->info->user_data['time_joined']),
				   	"BOXED_UPLOAD_YES" => (($mmhclass->info->user_data['upload_type'] == "boxed") ? "checked=\"checked\"" : NULL),
				   	"PRIVATE_GALLERY_NO" => (($mmhclass->info->user_data['private_gallery'] == 0) ? "checked=\"checked\"" : NULL),
				   	"PRIVATE_GALLERY_YES" => (($mmhclass->info->user_data['private_gallery'] == 1) ? "checked=\"checked\"" : NULL),
				   	"STANDARD_UPLOAD_YES" => (($mmhclass->info->user_data['upload_type'] == "standard") ? "checked=\"checked\"" : NULL),
				   	"USER_GROUP" => ((strpos($mmhclass->info->user_data['user_group'], "admin") == true) ? (($mmhclass->info->is_root == false) ? $mmhclass->lang['010'] : $mmhclass->lang['012']) : $mmhclass->lang['011']),
				);
	if ($mmhclass->info->is_user == true) {
				$user_id = $mmhclass->info->user_data['user_id'];
				$_SESSION['user_id'] = $user_id;
				}

				
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> - News </title>
   
    <meta name="version" content="1.0 BETA" />
    <meta name="description" content="<# SITE_NAME #> is an easy image hosting solution for everyone." />
    <meta name="keywords" content="image hosting, image hosting service, multiple image hosting, unlimited bandwidth, quick image hosting" />
    
   
    <link rel="shortcut icon" href="css/images/favicon.ico" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="css/news.css" rel="stylesheet" type="text/css" media="screen" />
    
    <script type="text/javascript" src="source/includes/scripts/jquery.js"></script>
    <script type="text/javascript" src="source/includes/scripts/genjscript.js"></script>
    <script type="text/javascript" src="source/includes/scripts/phpjs_00029.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.jdMenu.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.bgiframe.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.positionBy.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.dimensions.js"></script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-68771967-1', 'auto');
	  ga('send', 'pageview');

	</script>
</head>
<body class="page_cell">

<br>
<br>

<div class="logo"><a href="./" style="float: left;" class="logo"></a></div>

<div class="loginbotones">

	
</div>

<br>
<br>

<center>
			
			<div>
			<a href="./">Upload Files</a>
			&nbsp; <a href="./news">News</a>
			&nbsp; <a href="./faq">Faq</a>
			&nbsp; <a href="./affiliate" style="color: rgb(63, 188, 39);">Earn Money</a>
			<br>

			</div>	
	
</center>
      
<div id="page_body" class="page_body">



<center>
<h1>News</h1>
</center>
<br><br>
<div id="post-71" class="post">
<h2 class="post-title"> Welcome to ImgWolf.com - Free Image Hosting To Earn Money</h2>	
<div class="post-meta">Posted on Febrary 8, 2015</div>
			
<div class="post-content">
<p>Hello,</br></br></p>
<p>We are proud to announce the start of ImgWolf.com, a free image hosting industry that will help you share your images and EARN MONEY!. </br></br></p>
<p>
It is very important to us that you read our <a target="_blank" href="/tos">Terms of Service</a> and our <a target="_blank" href="/affiliate">Affiliate Section</a> before you start using our website.
</br>
</br>
</p>
<p>If you have any doubts about this feel free to <a target="_blank" href="/contact_us">contact us</a> and we will assist you as soon as possible.</br></br></p>
<p>Kind Regards,<br />
ImgWolf.com Support</p>
</div>
</div>



</div>
    	
<div id="footer_cell" class="footer_cell">
	
<div style="color:#444;font-size:12px;">
Copyright &copy; 2015 ImgWolf, All Rights Reserved.
</div>

<div style="margin:3px 0 10px 0;">

<a href="./">Home</a> | 
<a href="./news">News</a> | 
<a href="./dmca">Report abuse</a> | 
<a href="./faq">FAQ</a> | 
<a href="./tos">Terms of service</a> | 
<a href="./tools">Tools</a> | 
<a href="./contact_us">Contact Us</a>

</div>

</div>

    

</body>
</html>