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
				
				
				//payment modification 
				
				
				$payment_id = $_GET["payment_id"];
				
				$sql1 = "SELECT * FROM payments WHERE id ='".$payment_id."'";

				$consulta1 = mysql_query($sql1); 

				$fetch1 = mysql_fetch_array($consulta1);
				
				$amount = $fetch1['amount'];
				
				$si = "si";
				
				$vacio = "";
				$sql2 = "UPDATE payments SET pending='".mysql_real_escape_string($vacio)."' WHERE id='".mysql_real_escape_string($payment_id)."'"; 
				$consulta2  = mysql_query($sql2); 
				
				
				$sql3 = "UPDATE payments SET pagado='".mysql_real_escape_string($si)."' WHERE id='".mysql_real_escape_string($payment_id)."'"; 
				$consulta3  = mysql_query($sql3); 
				
				//end payment modification
				
				
				
				
				//user earnings update
				
				$user_id = $_GET["user_id"];
				
				$sql = "SELECT payedbalance FROM mmh_user_info WHERE user_id ='".$user_id."'";

				$consulta = mysql_query($sql); 

				$fetch = mysql_fetch_array($consulta);

				$payedbalance = $fetch['payedbalance'];
				
				$payedbalance = $payedbalance + $amount;
				
				$sql4 = "UPDATE mmh_user_info SET payedbalance='".mysql_real_escape_string($payedbalance)."' WHERE user_id='".mysql_real_escape_string($user_id)."'"; 
				$consulta4  = mysql_query($sql4); 
				
				
				header("location:adminpayments.php");
				}}
?>