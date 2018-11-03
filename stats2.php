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
				
				
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-us" xml:lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="imagetoolbar" content="no" />
    
    <title><?php echo $siteinfo_title;?> - Statistics</title>
   
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
<h1>Statistics</h1>
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
<div class="rightnav">
<label><b>&nbsp;&nbsp;&nbsp;Total Available Balance ($): </b><?php echo round($realbalance2, 4);?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><b>Total Payout ($): </b><?php echo $payedbalance2;?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><b>Pending Payments ($): </b><?php echo $pendiente;?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><b>Total Earned ($): </b><?php echo $totalbalance2;?></label>

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
	<br>

<form method="post" action="">
From Date: <input type="text" name="fecha11" id="fecha11" value="<?php echo $fecha11;?>"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
To Date: <input type="text" name="fecha22" id="fecha22" value="<?php echo $fecha22;?>"/>
<br>
<br>
<br>
<input type="submit" class="button1" value="Show statistics"/>
</form>


<br>
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
	

	
	<div style="margin-left: 305px; position: absolute;height: 12px;line-height: 13px;padding: 0 6px;background: #ffcc00;color: #111;margin-top: -1px;border-radius: 10px;font-size: 10px;font-weight: bold;font-family: Arial,sans-serif;text-shadow: 0 1px 0 rgba(255,255,255,0.3);box-shadow: inset 0 1px 0 rgba(255,255,255,0.3), 0 1px 0 rgba(0,0,0,0.5);" name="newws">	
	Tomorrow you will see today's earnings, Server time:
	<div id="hora"></div>
	</div>
	
	<br><br><br>


<div class="faqtitulo" style=" text-align: center; ">

My Referrals

</div>
<br>

<center>

    Your referral link is: 
	<br>
    <b>
        <label style="color: #119;">http://imgwolf.com/users.php?act=register&ref=<?php echo $user_id;?></label>
    </b>

</center>	
	
<table class="normal table-earnings-daily">
	<tbody>
	<tr>
		<th class="center" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Date Registered</th>
		<th class="center" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Username</th>
		<th class="center" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)">Earnings from ref.</th>
	</tr>
	


<?php
	
$sql585 =  "SELECT * FROM mmh_user_info WHERE referedby = '".$user_id."'";
$consulta585 = mysql_query($sql585);

$gananciastotalesdereferidos = 0;

while($row585 = mysql_fetch_assoc($consulta585))
{

$refuser = $row585["username"];

//echo $refuser."<br>";

$timejoined = $row585["time_joined"];

$timejoined2 = date ( 'Y-m-j' , $timejoined );

$gananciadelreferido = ($row585['payedbalance'] + $row585['realbalance'])/10;

//echo $gananciadelreferido."<br>";

//INSERTAR/UPDATE GANANCIA DEL REFERIDO SIN PAGAR

//tabla referals: id, user_id, refered_id, gananciadelreferido, gananciadelreferidounpaid, gananciadelreferidopayed.

/*
select * from referals where refered_id = '$refuser' 

if($gananciadelreferidopayed != 0){
$gananciadelreferido = $gananciadelreferido - $gananciadelreferidopayed;
}

*/

$gananciastotalesdereferidos = $gananciastotalesdereferidos + $gananciadelreferido;

//update de gananciastotalesdereferidos.


?>
			<tr>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $timejoined2;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $refuser;?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $gananciadelreferido;?></th>
			</tr>
<?php
}


//echo $gananciastotalesdereferidos;

?>

			<tr>
			<th style="background-color: white; color: black; font-size:12px;"></th>
			<th style="background-color: white; color: black; font-size:12px;"></th>
			<th class="center" style="font-size:12px; background-color: #rgba(82, 162, 200, 1)"><?php echo "Total: $".$gananciastotalesdereferidos;?></th>
		</tr>
</table>

</div>

<br>
<br>
<br>
<br>
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