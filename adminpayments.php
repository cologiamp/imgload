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
				
				$user_id = $_POST["user_id"];
				//$mmhclass->templ->output("stats", "stats_page");
				if($mmhclass->info->is_admin == true){
				?>
				
				
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> &raquo; Admin Payments</title>
   
    <meta name="version" content="1.0 BETA" />
    <meta name="description" content="<# SITE_NAME #> is an easy image hosting solution for everyone." />
    <meta name="keywords" content="image hosting, image hosting service, multiple image hosting, unlimited bandwidth, quick image hosting" />
    
   
    <link rel="shortcut icon" href="css/images/favicon.ico" />
    <link href="theme/style.css" rel="stylesheet" type="text/css" media="screen" />
    
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
	$("#fecha1").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#fecha2").datepicker({ dateFormat: 'yy-mm-dd' });
	});
	</script>

</head>
<body class="page_cell">

	<div class="members_bar">
			<div class="align_left">
				Logged in as: <a href="users.php?act=gallery"><?php echo $mmhclass->info->user_data['username'];?></a> 
			</div>
            
			<div class="align_right">        
				<a href="admin.php">Admin Control Panel</a> &bull;
				<a href="users.php?act=gallery">My Gallery</a> &bull;
				<a href="stats.php">Statistics</a> &bull;
				<a href="payments.php">Payments</a> &bull;
				<a href="users.php?act=settings">Settings</a> &bull;
				<a href="users.php?act=logout">Log Out</a>
			</div>
			
	</div>
	
	
	<a href="./" class="logo"></a>
    
	
	<div class="nav_menu">
		<ul>
			<li><a href="admin.php">Dashboard</a></li>
			<li><a href="index.php">Site Home</a></li>
			<li><a href="admin.php?act=file_logs">File Logs</a></li>
			<li><a href="admin.php?act=robot_logs">Search Engine Logs</a></li>
			<li><a href="admin.php?act=ban_control">Ban Control</a></li>
			<li><a href="admin.php?act=site_settings">Site Settings</a></li>
			<li><a href="admin.php?act=user_list">User Management</a></li>
			<li><a href="admin.php?act=mass_email">Bulk E-Mail</a></li>
			<li><a href="adminstats.php">Users's stats</a></li>
			<li><a href="adminpayments.php">Users's payments</a></li>

			</ul>
	</div>
      
<div id="page_body" class="page_body">
<center>
<h1>Admin Payments</h1>
</center>

<div id="total">

<table style="padding: 15px; border:1px solid;">

<?php
$sql23 = "SELECT * FROM payments ORDER BY id DESC";
$consulta23 = mysql_query($sql23);
$numero= mysql_num_rows($consulta23);

if (mysql_num_rows($consulta23) == 0) {
}
while ($row23 = mysql_fetch_assoc($consulta23)) {
?>
<tr style="padding: 15px; border:1px solid;">
<td name="id" style="padding: 15px; border:1px solid;">
<?php 
$id = $row23["id"];
echo "Payment ID: ".$id;
?>
</td>

<td name="user_id" style="padding: 15px; border:1px solid;">
<?php 
$user_id = $row23["username"];
echo "USER ID: ".$user_id;
?></td>


<td name="paypal" style="padding: 15px; border:1px solid;">
<?php 
$method = $row23["method"];
echo "Method: ".$method;
?>
</td>

<td name="payza" style="padding: 15px; border:1px solid;">
<?php 
$address = $row23["address"];
echo "Email Address: ".$address;
?>
</td>

<td name="amount" style="padding: 15px; border:1px solid;">
<?php 
$amount = $row23["amount"];
echo "Amount: ".$amount;
?>
</td>

<td name="pagado" style="padding: 15px; border:1px solid;">
<?php 
$pagado = $row23["pagado"];
if($pagado == "si"){
echo "Payed?: "." Yes";
}else{
?>
<label style="color:red;">
<?php
echo "Payed?: "." No";
?>
</label>
<?php } ?>
</td>

<td name="pending" style="padding: 15px; border:1px solid;">
<?php 
$pending = $row23["pending"];
echo "Pending: ".$pending;
?>
</td style="padding: 15px; border:1px solid;">


<td name="fecha" style="padding: 15px; border:1px solid;">
<?php 
$dia = $row23["dia"];
$mes = $row23["mes"];
$ano = $row23["ano"];

echo "Fecha: ".$dia."/".$mes."/20".$ano;
?>
</td>

<td name="pagar" style="padding: 15px; border:1px solid;">
<a href="send.php?payment_id=<?php echo $id;?>&user_id=<?php echo $user_id;?>">Payment Sended</a>
</td>

<td name="pagar" style="padding: 15px; border:1px solid;">
<a href="del.php?payment_id=<?php echo $id;?>&user_id=<?php echo $user_id;?>">Delete Payment</a>
</td>

</tr>
<?php			
}
?>


</table>


</div>


</div>
    	
	<div id="footer_cell" class="footer_cell">
	
	<table align="center" border="0" cellpadding="1" cellspacing="0" width="100%">
  <tbody>
  <tr>	
  
  				<td align="left">
			<a class="footer-content" href="./">Home</a>  | 
			<a class="footer-content" href="contact.php?act=file_report">Report abuse</a>  |  
			<a class="footer-content" href="info.php?act=rules">ToS</a>  |
			<a class="footer-content" href="info.php?act=privacy_policy">Privacy policy</a> |
			<a class="footer-content" href="faq.php">FAQ</a> |
			<a class="footer-content" href="contact.php?act=contact_us">Contact</a>

		</td>
		<td class="footer-content" align="right">Copyright &copy; 2013 <?php echo $siteinfo_title;?>. All rights reserved</td>
	</tr>
	</tbody>
 

</table>

</div>

    

</body>
</html>
				
				
<?php
			}}
?>