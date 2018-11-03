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
				
				
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> - Payments</title>
   
    <meta name="version" content="1.0 BETA" />
    <meta name="description" content="<# SITE_NAME #> is an easy image hosting solution for everyone." />
    <meta name="keywords" content="image hosting, image hosting service, multiple image hosting, unlimited bandwidth, quick image hosting" />
    
   
    <link rel="shortcut icon" href="css/images/favicon.ico" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
    
    <script type="text/javascript" src="source/includes/scripts/jquery.js"></script>
    <script type="text/javascript" src="source/includes/scripts/genjscript.js"></script>
    <script type="text/javascript" src="source/includes/scripts/phpjs_00029.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.jdMenu.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.bgiframe.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.positionBy.js"></script>
    <script type="text/javascript" src="source/includes/scripts/jquery.dimensions.js"></script>

	<link rel="stylesheet" href="source/includes/scripts/jquery-ui.css" />
    <script src="source/includes/scripts/jquery-1.8.2.js"></script>
    <script src="source/includes/scripts/jquery-ui.js"></script>
	


	<script type="text/javascript">
	$(document).ready(function(){
	$("#fecha11").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#fecha22").datepicker({ dateFormat: 'yy-mm-dd' });
	});
	</script>
	
	<script type="text/javascript">
	 $('#demoSelect').change(function(){
        $('#address').val($(this).val());
    });
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

<br>

<div align="center">

<form action="" method="post" name="myform">
<input type="hidden" name="username" value="<?php echo $user_id;?>" />
    

		<Table class="tbl1" cellpadding=2 cellspacing=1 width="310px">
		
		<tr class="hdr">
		<td colspan="2">
		<h1><b>Request your payment</b>
		</h1>
		</td>
		</tr>
		
		<TR><TD align=right><b style="margin-left: 105px;">Balance: </b></TD>
		<TD>
		<b>$ <?php echo round($mmhclass->info->user_data['realbalance'], 4);?></b>
		</TD></TR>

		<TR><TD align=right><b style="margin-left: 105px;">Method: </b></TD>
		<TD>			
		
		<select id="samples" name="method">
		<option value="<?php echo "Paypal,".$mmhclass->info->user_data['paypal_address'];?>">Paypal</option>
		<option value="<?php echo "Payza,".$mmhclass->info->user_data['payza_address'];?>">Payza</option>
		</select>

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
		
		</TD></TR>
		
		<TR><TD align=right><b style="margin-left: 105px;">Email/Account: </b></TD>
		<TD>
				
		<input type="email" id="field0" name="address" id="address" class="input_field" value="<?php echo $mmhclass->info->user_data['paypal_address'];?>" />

		</TD></TR>

		<TR><TD align=right width="1%" nowrap><b>Amount ($): </b></TD>
		<TD>
		<input type="text" class="input_field" name="amount"/>
		</TD></TR>
		
		</Table>


<center>
<br>
<br>

<input type="submit" class="button1" value="Request payment"/>

<br>
<br>

</center>

</form>

<p align="center" style="color: red; font-weight: bold;"><?php echo $message;?></p>

<br><br>

<Table class="tbl1" cellpadding=2 cellspacing=1 width="600px">
<tr>
<th style="background-color:#f0f0f0; color: black; font-size:12px;">Date</th>
<th style="background-color:#f0f0f0; color: black; font-size:12px;">Email</th>
<th style="background-color:#f0f0f0; color: black; font-size:12px;">Method</th>
<th style="background-color:#f0f0f0; color: black; font-size:12px;">Status</th>
<th style="background-color:#f0f0f0; color: black; font-size:12px;">Amount</th>
</tr>
<?php
	$sql28 = "SELECT * FROM payments WHERE username = '".$user_id."'";

	$consulta28  = mysql_query($sql28); 

	while ($resEmp = mysql_fetch_assoc($consulta28)) 
		{
			?>
			<tr>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;">
			<?php
			$dia = $resEmp['dia'];
			$mes = $resEmp['mes'];
			$ano = $resEmp['ano'];
			$fecha1 = "20".$ano."-".$mes."-".$dia;
			echo $fecha1;
			?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['address'];?></th>
			
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['method'];?></th>
			
			<th style="background-color:#f0f0f0; color: black; font-size:12px;">
			<?php
			if($resEmp['pending'] == ""){
			echo "Paid";
			}else{
			echo "Pending";
			}
			?>
			</th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo "$".$resEmp['amount'];?></th>
			</tr>
			
		   <?php
		   $gananciasperiodo = $gananciasperiodo + $resEmp['ganancias'];
		}
?>

</table>
</div>

<br>
<br>


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
				
				
<?php
			}
?>
