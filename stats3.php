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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> - Statistics</title>
   
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
<div class="col-xs-12">

<center>
<h1 class="statisticss">Statistics</h1>
</center>

<div id="total">
<?php

$sql144 = "SELECT * FROM mmh_user_info WHERE user_id ='".$user_id."'";

$consulta144 = mysql_query($sql144); 

$fetch144 = mysql_fetch_array($consulta144);

$payedbalance2 = $fetch144['payedbalance'];

$realbalance2 = $fetch144['realbalance'];

$totalbalance2 = $realbalance2 + $payedbalance2;

//PEDIR SOLO PARA EL PENDING
$no = "no";

$sql88 = "SELECT * FROM payments WHERE username ='".$user_id."' AND pagado = '".$no."'";

$consulta88 = mysql_query($sql88); 

$fetch88 = mysql_fetch_array($consulta88);

$pendiente = $fetch88['pending'];

?>
<br>
<div class="row" style="background-color: rgba(215, 220, 255, 1); border-top: 1px solid rgba(4, 43, 123, 1);">

<div class="col-xs-3">
<h5 style="color: #4c4c4c;"><b>Total Available Balance ($): <span style="color: black;"><?php echo round($realbalance2, 4);?></span></b></h5>
</div>
<div class="col-xs-3">
<h5 style="color: #4c4c4c;"><b>Total Payout ($): <span style="color: black;"><?php echo $payedbalance2;?></span></b></h5>
</div>
<div class="col-xs-3">
<h5 style="color: #4c4c4c;"><b>Pending Payments ($): <span style="color: black;"><?php echo $pendiente;?></span></b></h5>
</div>
<div class="col-xs-3">
<h5 style="color: #4c4c4c;"><b>Total Earned ($): <span style="color: black;"><?php echo $totalbalance2;?></span></b></h5>
</div>

</div>

<br>


</div>

<div align="center" id="all">
<?php

if($_POST["fecha11"]=="" OR $_POST["fecha22"]==""){
//

$diaman = date('j',time()+84600);
$anohoy = date('Y',time()+84600);
$meshoy = date('m',time()+84600);


if($diaman < 10){
$diaman = "0".$diaman;
}

$fecha22 = $anohoy."-".$meshoy."-".$diaman;

$fecha88 = $fecha22;
//


//$fecha2 = date('Y-m-j');



$fecha22totime = strtotime($fecha22);


$fecha11 = strtotime ( '-10 day' , strtotime ( $fecha22 ) ) ;
$fecha11 = date ( 'Y-m-j' , $fecha11 );

$fecha11array = explode("-", $fecha11);
$dia111 = $fecha11array[2];    
$mes111 = $fecha11array[1];
$ano111 = $fecha11array[0];

if($dia111 < 10){
$dia111 = "0".$dia111;
}

$fecha11 = $ano111."-".$mes111."-".$dia111;

$fecha11totime = strtotime($fecha11);
}else{

$fecha11 = $_POST["fecha11"];

$fecha22 = $_POST["fecha22"];

$fecha11totime = strtotime($fecha11);

$fecha22totime = strtotime($fecha22);
}
?>

	
	
	<br>

<form method="post" action="" style="width: 50%">
<div class="form-group field-contactform-name" style="display: inline-block; width: 40%">
<label class="control-label" for="fecha11" style="width: 75px; display: inline-block;">From Date:</label>
<input type="text" id="fecha11" name="fecha11" value="<?php echo $fecha11;?>" style="display: inline-block; width: 105px;">
</div>
<div class="form-group field-contactform-name" style="display: inline-block; width: 39%; margin-right: 30px;">
<label class="control-label" for="fecha22" style="width: 55px; display: inline-block;">To Date:</label>
<input type="text" id="fecha22" name="fecha22" value="<?php echo $fecha22;?>" style="display: inline-block; width: 105px;">
</div>
<div class="form-group field-contactform-name" style="display: inline-block; width: 11%">
<input type="submit" class="button1" value="Show statistics"/>
</div>

</form>

<br>

<?php
/*
$fecha1 = $_POST["fecha1"];
$fecha2 = $_POST["fecha2"];
*/
$a = 0;
$b = 0;
$c = 0;
$d = 0;


?>
<table class="normal table-earnings-daily">
	<tbody>
	<tr>
		<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)"></th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Zone A</th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Zone B</th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Zone C</th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Zone D</th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Referal</th>
		<th colspan="2" class="center" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Total</th>
	</tr>
	<tr>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Date</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Views</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Earnings</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Views</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Earnings</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Views</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Earnings</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Views</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Earnings</th>
	<th colspan="2" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Earnings</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Views</th>
	<th style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Earnings</th>
	</tr>
	
	<?php	
	
	$sql28 = "SELECT * FROM reports WHERE fecha BETWEEN '".$fecha11."' AND '".$fecha22."' AND user_id = '".$user_id."'";

	$consulta28  = mysql_query($sql28); 
	
	
	while ($resEmp = mysql_fetch_assoc($consulta28))
		{
			?>
			<tr>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['fecha'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['a'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['gananciasa'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['b'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['gananciasb'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['c'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['gananciasc'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['d'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['gananciasd'];?></th>
			<th colspan="2" style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['gananciasdeldiaderef'];?></th>
			<!--
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo "Ref";?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['gananciasdeldiaderef'];?></th>
			-->
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['visitas'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['ganancias'];?></th>
			</tr>
			
		   <?php
		   $gananciasperiodo = $gananciasperiodo + $resEmp['ganancias'];
		}
	?>

<?php
//ULTIMA FILA OSEA DE HOY
$hoyyy = date("Y-m-d");

if(!is_null($fecha88) OR strtotime($fecha22) > strtotime($hoyyy)){

$fecha88 = $hoyyy;

$fecha88totime = strtotime($fecha88);

$sql2555 =  "SELECT * FROM contador WHERE uploadedby = '".$user_id."' AND strtotime = '".$fecha88totime."'";
		$consulta2555 = mysql_query($sql2555);
		while($row2555 = mysql_fetch_assoc($consulta2555))
		{
		$elpais = $row2555['pais'];
		if($elpais=="US")
					{
						$a = $a+1;
					}
				else if($elpais=="GB")
					{
						$a = $a+1;
					}
				else if($elpais=="AU")
					{
						$a = $a+1;
					}
				else if($elpais=="NZ")
					{
						$a = $a+1;
					}
				else if($elpais=="UK")
					{
						$a = $a+1;
					}
				else if($elpais=="CA")
					{
						$a = $a+1;
					}
				else if($elpais=="IT")
					{
						$b = $b+1;
					}
				else if($elpais=="NL")
					{
						$b = $b+1;
					}		
					else if($elpais=="IR")
					{
						$b = $b+1;
					}
					else if($elpais=="AT")
					{
						$b = $b+1;
					}		
					else if($elpais=="ES")
					{
						$b = $b+1;
					}
					else if($elpais=="FR")
					{
						$b = $b+1;
					}
					else if($elpais=="FI")
					{
						$b = $b+1;
					}		
					else if($elpais=="BE")
					{
						$b = $b+1;
					}
					else if($elpais=="SZ")
					{
						$b = $b+1;
					}
					else if($elpais=="DE")
					{
						$b = $b+1;
					}
					else if($elpais=="DK")
					{
						$b = $b+1;
					}
					else if($elpais=="GR")
					{
						$b = $b+1;
					}		
					else if($elpais=="LU")
					{
						$b = $b+1;
					}
					else if($elpais=="NO")
					{
						$b = $b+1;
					}
					else if($elpais=="PT")
					{
						$b = $b+1;
					}			
					else if($elpais=="SE")
					{
						$b = $b+1;
					}
				else if($elpais=="CY")
					{
						$c = $c+1;
					}
								else if($elpais=="CZ")
					{
						$c = $c+1;
					}			else if($elpais=="EE")
					{
						$c = $c+1;
					}			else if($elpais=="IL")
					{
						$c = $c+1;
					}			else if($elpais=="HU")
					{
						$c = $c+1;
					}			else if($elpais=="JP")
					{
						$c = $c+1;
					}			else if($elpais=="LV")
					{
						$c = $c+1;
					}			else if($elpais=="LT")
					{
						$c = $c+1;
					}			else if($elpais=="RU")
					{
						$c = $c+1;
					}			else if($elpais=="PL")
					{
						$c = $c+1;
					}			else if($elpais=="SK")
					{
						$c = $c+1;
					}
				else{
						$d = $d+1;
					}
		}

	$visitas = $a + $b + $c + $d;
	$gananciasa = $a * 0.001;
	$gananciasb = $b * 0.0005;
	$gananciasc = $c * 0.00025;
	$gananciasd = $d * 0.00010;

	$ganancias = $gananciasa + $gananciasb + $gananciasc + $gananciasd;
	
	$gananciastotales = $gananciastotales + $ganancias;



/*
if($fecha22 === date()){

$sql284 = "SELECT * FROM reports WHERE user_id ='".$user_id."' AND fecha";

$consulta284 = mysql_query($sql284); 

$fetch284 = mysql_fetch_array($consulta284);

$payedbalance2 = $fetch144['payedbalance'];

$realbalance2 = $fetch144['realbalance'];

$totalbalance2 = $realbalance2 + $payedbalance2;
*/

?>
			<tr>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $fecha88;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $a;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $gananciasa;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $b;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $gananciasb;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $c;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $gananciasc;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $d;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $gananciasd;?></th>
			<th colspan="2" style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo "..".$gananciasdeldiaderef;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $visitas;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $ganancias;?></th>
			</tr>

<?php

}

?>

<tr class="tr-total">
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
<td style="visibility: hidden;"></td>
 
		<th colspan="2" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Total: $<?php echo $gananciasperiodo+$ganancias;?></th>
</tbody>
</table>

<br>


	<script>
		window.onload=hora;
		fecha = new Date("<?php echo date("d M Y G:i:s"); ?>");
		function hora(){
		var hora=fecha.getHours();
		var minutos=fecha.getMinutes();
		var segundos=fecha.getSeconds();
		if(hora<10){ hora='0'+hora;}
		if(minutos<10){minutos='0'+minutos; }
		if(segundos<10){ segundos='0'+segundos; }
		fech=hora+":"+minutos+":"+segundos;
		document.getElementById('hora').innerHTML=fech;
		fecha.setSeconds(fecha.getSeconds()+1);
		setTimeout("hora()",1000);
		}
		</script>
	

	
	<div style="margin-left: auto; margin-right: auto; width: 340px; height: 12px;line-height: 13px;padding: 0 6px;background: #ffcc00;color: #111;margin-top: -1px;border-radius: 10px;font-size: 10px;font-weight: bold;font-family: Arial,sans-serif;text-shadow: 0 1px 0 rgba(255,255,255,0.3);box-shadow: inset 0 1px 0 rgba(255,255,255,0.3), 0 1px 0 rgba(0,0,0,0.5);" name="newws">	
	<span>Statistics can take up to 15 minutes to be updated. Server time:</span>
	<div id="hora"></div>

	</div>
	
	<br>
	<br>
	<br>

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
<h5>ImgLoad &copy;</h5>
<ul>
<li><a href="./about">Home</a></li>
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
