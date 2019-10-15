<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1250799957 - Thursday, August 20, 2009, 04:25:57 PM EDT -0400
	// ======================================== /
	
	require_once "./source/includes/data.php";
	require_once "{$mmhclass->info->root_path}source/language/stats.php";
	require("conexion.php");
	require("siteinfo.php");
	session_start();
	
	
	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);
	
	$mmhclass->templ->templ_vars[] = array(
		"BASE_URL" => $mmhclass->info->base_url,
		"SITE_NAME" => $mmhclass->info->config['site_name'],
	);
	
	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);
			
			if ($mmhclass->info->is_user == false) {
				$mmhclass->templ->error($mmhclass->lang['002'], true);
			} else {
			
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
				
				$user_id = $mmhclass->info->user_data['user_id'];
				//$mmhclass->templ->output("stats", "stats_page");
				

				$dia = date("d");
				$mes = date("m");
				$ano = date("y");
				$fecha1 = $dia.$mes.$ano;

				$username = $user_id;

				$address = $_POST["address"];

				$amount = $_POST["amount"];

				$amount = $_POST["amount"];

				$pending = $amount;
				
				$method = $_POST['method'];
	
				$method1 = explode(",",$method);
				
				$method_final = $method1[0];
		
		
				/*
				$filename_array = explode(".",$filename);
				
				$filename_thumb = $filename_array[0]."_thumb".".".$filename_array[1];
				*/	
						
				if($user_id == "" OR $amount < 5){
				
				$message = "Minimum amount is set at $5.00";

				}else if($payzamail == "" AND $address == ""){
				
				$message = "You have to enter your account address.";
				}else if($amount > $mmhclass->info->user_data['realbalance']){
				
				$message = "You have not enough balance to perform this action.";
				
				}else{
				
				$no = "no";
				
				$sql88 = "SELECT * FROM payments WHERE username ='".$user_id."' ORDER BY id DESC";

				$consulta88 = mysql_query($sql88); 
				
				$fetch88 = mysql_fetch_array($consulta88);
				
				$pagado = $fetch88['pagado'];
				
				if($pagado == "no"){
				$message = "You have a pending payment request, wait until we proccess it.";
				}else{
				
				$no = "no";
				$sql = "INSERT INTO payments (address, amount, username, method, pending, fecha, dia, mes, ano, pagado) VALUES ('".mysql_real_escape_string($address)."', '".mysql_real_escape_string($amount)."','".mysql_real_escape_string($username)."','".mysql_real_escape_string($method_final)."','".mysql_real_escape_string($pending)."','".mysql_real_escape_string($fecha1)."','".mysql_real_escape_string($dia)."','".mysql_real_escape_string($mes)."','".mysql_real_escape_string($ano)."','".mysql_real_escape_string($no)."')";
				$consulta  = mysql_query($sql);
				if($consulta){
				
				$message = "Request has been sent";
					
				}else{
				?>
				<script language="javascript" type="text/javascript">
						alert('Error');
						document.location.href = "./payments";
				</script>
				<?php
				}}}
				?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> - Payments</title>
   
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
	
	

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" media="all" href="css/font-awesome/css/font-awesome.min.css" />

<link rel="stylesheet" href="source/includes/scripts/jquery-ui.css" />
<script src="source/includes/scripts/jquery-1.8.2.js"></script>
<script src="source/includes/scripts/jquery-ui.js"></script>


<script type="text/javascript">
$(document).ready(function(){
$("#fecha11").datepicker({ dateFormat: 'yy-mm-dd' });
$("#fecha22").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

</head>

<body class="page_cell">



<div id="header" class="container-fluid">
<div class="container">
<div class="row">
<div class="col-sm-3 logo-holder"><a href="./"><img src="./css/images/logo.png" alt="Openload"></a></div>
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
<div class="col-sm-6 sign-up-form-holder">
<h3 class="other-title-bold">Request a payment</h3>
<h4>Balance: $ <?php echo round($mmhclass->info->user_data['realbalance'], 4);?></h4>
<form id="register-form" class="quick-form" action="" method="post" name="myform">
<input type="hidden" name="username" value="<?php echo $user_id;?>" />


<div class="form-group field-registerform-email required">
	<select id="samples" name="method">
	<option value="<?php echo "Paypal,".$mmhclass->info->user_data['paypal_address'];?>">Paypal</option>
	<option value="<?php echo "Payza,".$mmhclass->info->user_data['payza_address'];?>">Payza</option>
	</select>
</div>

	<script type="text/javascript">
	document.getElementById('samples').onchange=function()
	{
		var samples=document.getElementById('samples');
		if(samples.value!='default')
		{
			// array of selected samples
			samples=samples.value.split(',');

			//apply to textfields
			document.getElementById('field0').value=samples[1];

		}
	}
	</script>

<div class="form-group field-registerform-email required">
<label class="control-label" for="registerform-email">Email address</label>
<input type="email" id="field0" class="form-control" name="address" value="<?php echo $mmhclass->info->user_data['paypal_address'];?>">
<p class="help-block help-block-error"></p>
</div>

<div class="form-group field-registerform-password required">
<label class="control-label" for="registerform-password">Amount</label>
<input type="text" class="form-control" name="amount">
<p class="help-block help-block-error"></p>
</div>

<div class="s-submit">
<button type="submit">Request Payment</button>
</div>
</form>

<br>
<p align="center" style="color: red; font-weight: bold;"><?php echo $message;?></p>

</div>
<div class="col-sm-6 sign-up-features-holder">
<h3 class="other-title-bold">Your payments.</h3>
<table class="table table-responsive table-striped table-hover">
<tbody>
	<tr>
		<th>Date</th>
		<th>Email</th>
		<th>Method</th>
		<th>Status</th>
		<th>Amount</th>
	</tr>
<?php
	$sql28 = "SELECT * FROM payments WHERE username = '".$user_id."'";

	$consulta28  = mysql_query($sql28); 

	while ($resEmp = mysql_fetch_assoc($consulta28)) 
		{
			?>
			<tr>
			<td>
			<?php
			$dia = $resEmp['dia'];
			$mes = $resEmp['mes'];
			$ano = $resEmp['ano'];
			$fecha1 = "20".$ano."-".$mes."-".$dia;
			echo $fecha1;
			?>
			</td>
			<td><?php echo $resEmp['address'];?></td>
			
			<td><?php echo $resEmp['method'];?></td>
			
			<td>
			<?php
			if($resEmp['pending'] == ""){
			echo "Paid";
			}else{
			echo "Pending";
			}
			?>
			</td>
			<td><?php echo "$".$resEmp['amount'];?></td>
			</tr>
			
		   <?php
		   $gananciasperiodo = $gananciasperiodo + $resEmp['ganancias'];
		}
?>
</tbody>
</table>


</div>
</div>
</div>
</div>


</div>

<div id="footer" class="container-fluid">
<div class="container">
<div class="row">
<div class="col-sm-5c col-xs-6">
<h5>ImgLoad &copy;</h5>
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

<?php
			}
?>
