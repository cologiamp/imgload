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
	require_once "./source/includes/data.php";
	require("conexion.php");
	require("siteinfo.php");
	session_start();
	$microtime = time();
	$_SESSION["microtime"] = $microtime;

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
				}else{
				$user_id = "0";
				$_SESSION['user_id'] = $user_id;
				}

				
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> - Flash Upload </title>
   
    <meta name="version" content="1.0 BETA" />
    <meta name="description" content="<# SITE_NAME #> is an easy image hosting solution for everyone." />
    <meta name="keywords" content="image hosting, image hosting service, multiple image hosting, unlimited bandwidth, quick image hosting" />
    
   
    <link rel="shortcut icon" href="css/images/favicon.ico" />
    
    <script type="text/javascript" src="source/includes/scripts/jquery.js"></script>
    <script type="text/javascript" src="source/includes/scripts/genjscript.js"></script>
    <script type="text/javascript" src="source/includes/scripts/phpjs_00029.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.jdMenu.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.bgiframe.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.positionBy.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.dimensions.js"></script>

	<link href="theme/default.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
	

<script type="text/javascript" src="js/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "js/swfupload.swf",
				upload_url: "fupload.php",
				//post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "30 MB",
				file_types : "*.jpg\;*.jpeg\;*.gif\;*.png\;",
				file_types_description : "*.jpg\;*.jpeg\;*.gif\;*.png\;",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "./css/images/TestImageNoText_65x29.png",
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Select Images</span>',
				button_text_style: ".theFont { text-align:center;font-family:'Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;color:#333;font-size:12px;font-weight:bold;text-shadow:0 1px 0 #FFFFFF;}",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete,	// Queue plugin event
				post_params : {
					thumbsize: 180,
					PHPSESSID: "<?php echo session_id();?>"
				}
			};

			swfu = new SWFUpload(settings);
			
			$("#upload_form select.thumbsize").change(function() {
				var post_params = swfu.settings.post_params;
				post_params.thumbsize = $(this).val();
				swfu.setPostParams(post_params);
			});
	     };
	</script>

</head>
<body class="page_cell">

<br>
<br>

<div class="logo"><a href="./" style="float: left;" class="logo"></a></div>
	
<div class="loginbotones">
	<div class="members_bar">
	
	</div> 
</div>
	
	<br>
	<br>
	<center>
<?php if ($mmhclass->info->is_user == true) { ?>
			<div>
			<a href="./">Upload Files</a>
			&nbsp; <a href="./mygallery">My Images</a>
			&nbsp; <a href="./stats">Statistics</a>
			&nbsp; <a href="./payments">Payments</a>
			&nbsp; <a href="./mysettings">My Settings</a>
			&nbsp; <a href="./affiliate" style="color: rgb(63, 188, 39);">Earn Money</a>
			&nbsp; <a href="./logout">Logout</a>

			<br>

			</div>	
<?php }else{ ?>		
			
			<div>
			<a href="./">Upload Files</a>
			&nbsp; <a href="./sign_up">Sign Up</a>
			&nbsp; <a href="./login">Login</a>
			&nbsp; <a href="./affiliate" style="color: rgb(63, 188, 39);">Earn Money</a>
			<br>

			</div>	


<?php }?>		
</center>
<div id="page_body" class="page_body">


<center>

<br />
<br />
Flash | <a href="./">Local</a> | <a href="./remote">Remote</a>
<br >

<center>
<form action="fupload.php" method="post" id="upload_form" enctype="multipart/form-data">
	
	<div class="grey">
		<br>
		<b>Images up to 30 Megabytes</b>
		<br>
		<br>

		<div style="margin-left:45px;" class="fieldset flash" id="fsUploadProgress">

        	<span class="legend">Upload Queue</span>
        </div>
        <div id="divStatus">0 Files Uploaded</div>
        	<div>
                	<span id="spanButtonPlaceHolder"></span>
			<input name="adult" value="1" type="hidden" />
            </div>
        <br />	
    	Thumbnail Size: 
		<select name="thumbsize" id="thumbsize" class="thumbsize">
			<option value="100">100x100(tiny)</option>
			<option value="160">160x160</option>
			<option value="180" selected="selected">180x180(standard)</option>
			<option value="220">220x220(large)</option>
			<option value="250">250x250(extra large)</option>
		</select>
	
	</div>

        <br />
	<div style="padding-top: 5px;"><input name="tos" checked="checked" type="checkbox" /> I have read and agreed to the <a target="_blank" href="/tos"> Terms of Service</a>. <br /><br /></div>
                        <input class="button1" id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
</form></center>
<br>


<br />
	
</center>


</div>



<div id="footer_cell" class="footer_cell">
	
<div style="color:#444;font-size:12px;">
Copyright &copy; 2015 ImgWolf, All Rights Reserved.
</div>

<div style="margin:3px 0 10px 0;">

<a href="./">Home</a> | 
<a href="./dmca">Report abuse</a> | 
<a href="./faq">FAQ</a> | 
<a href="./tos">Terms of service</a> | 
<a href="./contact_us">Contact Us</a>

</div>

</div>

    

</body>
</html>