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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> - Flash Upload </title>
   
    <meta name="version" content="1.0 BETA" />
    <meta name="description" content="<# SITE_NAME #> is a simple image hosting." />
    <meta name="keywords" content="image hosting, image hosting service, multiple image hosting, unlimited bandwidth, 
	quick image hosting, image, picture, hosting, screenshots, photos, photo, share, share images,
	share photos, share with friends, social, networking, free, unlimited	" />
    
    <base href="<# BASE_URL #>" />
	
	<meta name="juicyads-site-verification" content="57c08619fc5fd188f77c0123435c60ce"/>
    
	<link rel="shortcut icon" href="css/images/favicon.ico" />
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
			
    <script type="text/javascript" src="source/includes/scripts/jquery.js"></script>
    <script type="text/javascript" src="source/includes/scripts/genjscript.js"></script>
    <script type="text/javascript" src="source/includes/scripts/phpjs_00029.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.jdMenu.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.bgiframe.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.positionBy.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.dimensions.js"></script>
	
	<script type="text/javascript" src="http://netpopads.com/adp.php?tag=7615b91bb87c8e01601"></script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" media="all" href="css/font-awesome/css/font-awesome.min.css" />

</head>

<body class="page_cell">



<div id="header" class="container-fluid">
<div class="container">
<div class="row">
<div class="col-sm-3 logo-holder"><a href="/"><img src="/css/images/logo.png" alt="Openload"></a></div>
<div class="col-sm-9 menu-holder">
<div class="top-menu">
<?php if ($mmhclass->info->is_user == true) { ?>
	<a class="first-link" href="./">Upload</a>
	<a href="./mygallery">My Images</a>
	<a href="./stats">Statistics</a>
	<a href="./payments">Payments</a>
	<a href="./mysettings">My Settings</a>
	<a href="./logout">Logout</a>
	<div class="signup-button"><a href="./affiliate">Earn Money</a></div>
<?php }else{ ?>		
			
	<a class="first-link" href="./">Upload</a>
	<a href="./affiliate">Earn Money</a>
	<a class="sign-in-button" href="./login">Sign in</a>
	<div class="signup-button"><a href="./sign_up">Sign up</a></div>

<?php }?>		
</div>
</div>
</div>
</div>
</div>

      
	<div id="page_body" class="page_body">
<!-- NUEVO SIGN IN -->
<div class="sign-in-box">
<h3>Sign in</h3><div class="close-button">×</div>
<form id="login-form" class="quick-form" action="users.php?act=login-d" method="post">
<input type="hidden" name="return" value="<# RETURN_URL #>" />

<div class="form-group field-loginform-email required has-success">
<label class="control-label" for="loginform-email">Username</label>
<input type="text" id="loginform-email" class="form-control" name="username">
<p class="help-block help-block-error"></p>
</div>

<div class="form-group field-loginform-password required has-success">
<label class="control-label" for="loginform-password">Password</label>
<input type="password" id="loginform-password" class="form-control" name="password">
<p class="help-block help-block-error"></p>
</div>

<div class="s-checkbox">
<div class="form-group field-loginform-rememberme">
<div class="checkbox">
<label for="loginform-rememberme">
<input type="hidden" name="LoginForm[rememberMe]" value="0"><input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked="">
Remember Me
</label>
<p class="help-block help-block-error"></p>
</div>
</div>

</div>

<div class="submitcontainer">
<button type="submit">Sign In</button> </div>
</form>

<div class="s-link"><a class="forgot-button" href="./login">Forgot your password?</a></div>
</div>

<div class="forgot-box">
<h3>Forgot password?</h3><div class="close-button">×</div>
<form id="login-form" class="quick-form" action="users.php?act=lost_password-d" method="post">
<input type="hidden" name="return" value="<# RETURN_URL #>" />

<div class="form-group field-loginform-email required has-success">
<label class="control-label" for="loginform-email">Username</label>
<input type="text" id="loginform-email" class="form-control" name="username">
<p class="help-block help-block-error"></p>
</div>

<div class="form-group field-loginform-email required has-success">
<label class="control-label" for="loginform-email">Email Address</label>
<input type="email" id="loginform-email" class="form-control" name="email_address">
<p class="help-block help-block-error"></p>
</div>

<div class="">
<button type="submit">Reset Password</button>
</div>

</form>

</div>

<script>
        $(document).ready(function(){
            $(".sign-in-button").click(function(e){
                e.preventDefault();
                $('.sign-in-box').addClass('show-box');return false;
	});
	$(".close-button").click(function(){
		$(".sign-in-box").removeClass("show-box");
	});
        });
</script>

<script>
        $(document).ready(function(){
            $(".forgot-button").click(function(e){
                e.preventDefault();
                $('.forgot-box').addClass('show-box');return false;
	});
	$(".close-button").click(function(){
		$(".forgot-box").removeClass("show-box");
	});
        });
</script>
<!--FIN DEL NUEVO SIG IN -->

<div id="content" class="container-fluid">
<div class="container">
<div class="row" id="main">

<div class="col-xs-12">

<div align="center">
		<center><h2>Uploaded images</h2></center>
		<br>
		<p>Share links:</p>
		<br>
<textarea readonly onclick="highlight(this);" class="input_field" cols="50" rows="10" style="width: 780px;">
<?php
$sql = "SELECT * FROM mmh_file_storage WHERE microtime = '".mysql_real_escape_string($microtime)."'";

$consulta  = mysql_query($sql); 

while ($resEmp = mysql_fetch_assoc($consulta)) 
	{

$filename = $resEmp['filename'];

echo $siteinfo_basename."/viewer.php?file=".$filename."\n";
    }

?>
</textarea>
<br>
<br>
<p>Thumbnails for Websites</p>
<textarea readonly onclick="highlight(this);" class="input_field" cols="50" rows="10" style="width: 780px;">
<?php
$sql = "SELECT * FROM mmh_file_storage WHERE microtime = '".mysql_real_escape_string($microtime)."'";

$consulta  = mysql_query($sql); 

while ($resEmp = mysql_fetch_assoc($consulta)) 
	{

$filename = $resEmp['filename'];
$filename_thumb = $resEmp['filename_thumb'];

echo "<a href='".$siteinfo_basename."/viewer.php?file=".$filename."'><img src='".$siteinfo_basename."/images/".$filename_thumb."'></a>"." ";

//echo "<a href='http://imgpizza.com/viewer.php?file=".$filename."'><img src='http://imgpizza.com/images/".$filename_thumb."'></a>"." ";
    }
?>
</textarea>
<br>
<br>
<p>Thumbnails for Forums</p>
<textarea readonly onclick="highlight(this);" class="input_field" cols="50" rows="10" style="width: 780px;">
<?php
$sql = "SELECT * FROM mmh_file_storage WHERE microtime = '".mysql_real_escape_string($microtime)."'";

$consulta  = mysql_query($sql); 

while ($resEmp = mysql_fetch_assoc($consulta)) 
	{

$filename = $resEmp['filename'];
$filename_thumb = $resEmp['filename_thumb'];

echo "[URL=".$siteinfo_basename."/viewer.php?file=".$filename."][IMG]".$siteinfo_basename."/images/".$filename_thumb."[/IMG][/URL]"." ";
	}

?>
</textarea>
<br>
<br>
<p>Direct Link for Forums</p>
<textarea readonly onclick="highlight(this);" class="input_field" cols="50" rows="10" style="width: 780px;">
<?php
$sql = "SELECT * FROM mmh_file_storage WHERE microtime = '".mysql_real_escape_string($microtime)."'";

$consulta  = mysql_query($sql); 

while ($resEmp = mysql_fetch_assoc($consulta)) 
	{

$filename = $resEmp['filename'];

echo "[URL]".$siteinfo_basename."/viewer.php?file=".$filename."[/URL]"." ";
	}

?>
</textarea>
<br>
<br>
</div>

<div align="center" name="thumbnails">

<div class="table_border2">
<?php
$sql = "SELECT * FROM mmh_file_storage WHERE microtime = '".mysql_real_escape_string($microtime)."'";

$consulta  = mysql_query($sql); 

while ($resEmp = mysql_fetch_assoc($consulta)) 
	{
	$filename = $resEmp['filename'];
	$filename_thumb = $resEmp['filename_thumb'];

?>
<table style="font-family: Arial, Verdana, Helvetica, sans-serif;font-size:11px;" width="860" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td align="center" valign="middle" width="221" rowspan="5">
	<a target="_blank" href="viewer.php?file=<?php echo $filename;?>"><img src="images/<?php echo $filename_thumb?>"/></a>
	</td>
    <td valign="middle" style="margin-left:1px;" width="579">
	<input type="text" onclick="highlight(this);" readonly class="input_field" rows=1 style="width: 450px;" value="<?php
	echo $siteinfo_basename."/viewer.php?file=".$filename;
	?>"/>
	Share link
	</td>
  </tr>
  <tr>
    <td valign="middle" width="635"  style="margin-left:1px;">
	<input type="text" onclick="highlight(this);" readonly class="input_field" rows=1 style="width: 450px;" value="<?php
	echo "<a href='".$siteinfo_basename."/viewer.php?file=".$filename."'><img src='".$siteinfo_basename."/images/".$filename_thumb."'></a>";
	?>"/>
 Thumbnail for website
	</td>
  </tr>
  <tr>
    <td valign="middle" width="635" style="margin-left:1px;">
	<input type="text" onclick="highlight(this);" readonly class="input_field" rows=1 style="width: 450px;" value="<?php
	echo "[URL=".$siteinfo_basename."/viewer.php?file=".$filename."][IMG]".$siteinfo_basename."/images/".$filename_thumb."[/IMG][/URL]";
	?>"/>
 Thumbnail for forum
	</td>
  </tr>
  <tr>
    <td valign="middle" width="635" style="margin-left:1px;">
	<input type="text" onclick="highlight(this);" readonly class="input_field" style="width: 450px;" value="<?php
	echo "[URL]".$siteinfo_basename."/viewer.php?file=".$filename."[/URL]";
	?>"/>
 Direct Link for forum
	</td>
  </tr>
  <tr>
    <td width="635" style="margin-left:1px;">
	<input type="text" onclick="highlight(this);" readonly class="input_field" rows=1 style="width: 450px;" value="<?php
	echo "<a href='".$siteinfo_basename."'>Free image hosting</a> by ImgWolf.";
	?>"/> Link to us	
	</td>
  </tr>
</table>
<br>
<br>
<br>
<?php }?>
</div>

</div>

</div>

</div>
</div>
</div>


</div>

<div id="footer" class="container-fluid">
<div class="container">
<div class="row">
<div class="col-sm-5c col-xs-6">
<h5>ImgWolf &copy;</h5>
<ul>
<li><a href="./">Home</a></li>
<li><a href="./faq">FAQ</a></li>
<li><a href="./contact">Contact us</a></li>
</ul>
</div>
<div class="col-sm-5c col-xs-6">
<h5>Policy</h5>
<ul>
<li><a href="./tos">Terms and Conditions</a></li>
<li><a href="./privacy">Privacy Policy</a></li>
<li><a href="./dmca">Report Abuse</a></li>
</ul>
</div>

<div class="col-sm-5c col-xs-12">
<i class="fa fa-globe"></i><h5 class="lang">Languages</h5>
<ul>
<li><a href="#">English</a></li>
</ul>
</div>
</div>
</div>
</div>

</body>
</html>

