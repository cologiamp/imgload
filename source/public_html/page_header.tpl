<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><# PAGE_TITLE #></title>
   
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
	
    <script type="text/javascript" src="http://198.7.63.44/netpopads/adp.php?tag=7615b91bb87c8e01601"></script>
    
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" media="all" href="css/font-awesome/css/font-awesome.min.css" />

</head>
<body class="page_cell">



<div id="header" class="container-fluid">
<div class="container">
<div class="row">
<div class="col-sm-3 logo-holder"><a href="./"><img src="./css/images/logo.png" alt="Openload"></a></div>
<div class="col-sm-9 menu-holder">
<div class="top-menu">
<if="$mmhclass->info->is_user == true">	
	<!--
	<div>
	<a href="./">Upload Files</a>
	&nbsp; <a href="./mygallery">My Images</a>
	&nbsp; <a href="./stats">Statistics</a>
	&nbsp; <a href="./payments">Payments</a>
	&nbsp; <a href="./mysettings">My Settings</a>
	&nbsp; <a href="./affiliate" style="color: rgb(63, 188, 39);">Earn Money</a>
	&nbsp; <a href="./logout">Logout</a>
	<br/>
	</div>
	-->	
	<a class="first-link" href="./">Upload</a>
	<a href="./mygallery">My Images</a>
	<a href="./stats">Statistics</a>
	<a href="./payments">Payments</a>
	<a href="./mysettings">My Settings</a>
	<a href="./logout">Logout</a>
	<div class="signup-button"><a href="./affiliate">Earn Money</a></div>
<else>
	<!--
	<div>
	<a href="./">Upload Files</a>
	&nbsp; <a href="./sign_up">Sign Up</a>
	&nbsp; <a onclick="toggle_lightbox('users.php?act=login', 'login_lightbox');" href="javascript:void(0);">Login</a> 
	&nbsp; <a href="./affiliate" style="color: rgb(63, 188, 39);">Earn Money</a>
	<br/>
	</div>	
	-->
	<a class="first-link" href="./">Upload</a>
	<a href="./affiliate">Earn Money</a>
	<a class="sign-in-button" href="./login">Sign in</a>
	<div class="signup-button"><a href="./sign_up">Sign up</a></div>
</endif>
</div>
</div>
</div>
</div>
</div>

	
<div class="loginbotones">
	<div class="members_bar">
		<if="$mmhclass->info->is_user == true">	
            <div class="align_right">

				<if="$mmhclass->info->is_admin == true">
					<a href="admin.php">Admin Control Panel</a>
				</endif>

			</div>
			
		<else>
				<div class="guest_links">

				</div>
		</endif>
	</div>

</div>

<center>	

    <if="stripos($mmhclass->input->server_vars['http_user_agent'], "MSIE 6.0") !== false && stripos($mmhclass->input->server_vars['http_user_agent'], "MSIE 8.0") === false && stripos($mmhclass->input->server_vars['http_user_agent'], "MSIE 7.0") === false">
       <div class="slideout_warning">
            <span class="picture ie_picture">&nbsp;</span>
            <span class="info">
                <h1>Unsupported Web Browser</h1>
                The web browser that you are running is not supported. 
                Please try one of the following: <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">Internet Explorer 8</a>, <a href="http://www.apple.com/safari/">Safari</a>, <a href="http://firefox.com">Firefox</a>, or <a href="http://opera.com">Opera</a>.
            </span>
        </div>
    <else>
        <noscript>
           <div class="slideout_warning">
                <span class="picture">&nbsp;</span>
                <span class="info">
                    <h1>JavaScript is Disabled!</h1>
                    Your browser currently has JavaScript disabled or does not support it.
                    Since this website uses JavaScript extensively it is recommended to <a href="http://support.microsoft.com/gp/howtoscript">enable it</a>.
                </span>
            </div>
        </noscript>
    </endif>
 
</center>
 
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