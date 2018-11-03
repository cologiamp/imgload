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
    
    <title><?php echo $siteinfo_title;?> &raquo; Statistics</title>
   
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

</head>
<body class="page_cell">

<div class="logo"><a href="./" style="float: left;" class="logo"></a></div>
	
<div class="loginbotones">
	<div class="members_bar">
	
	<?php if ($mmhclass->info->is_user == true) { ?>
			<div class="align_right">
				<div class="guest_links">Logged in as: <a href="users.php?act=gallery"><?php echo $mmhclass->info->user_data['username']; ?></a> | <a href="users.php?act=settings">My Settings</a> |
				<a href="users.php?act=logout">Log Out</a> 
				</div>
			</div>
	<?php }else{ ?>		
		
				<div class="guest_links">
				You are not logged in <a href="javascript:void(0);" onmouseover="loginMenu();" onclick="loginMenu();', 'login_lightbox');">Log In</a> | <a href="users.php?act=register">Sign Up</a>
				
				<div id="loginMenu" class="button5" style="display: none;">
					<form action="users.php?act=login-d" method="post">
					<span class="loginbotonaso">Log In:</span><br><br>
						<p><label>Username:&nbsp;</label><input name="username" class="input_field" type="text" /></p>

							<div style="margin-right: -7px;">
							<p>
							<label>Password:&nbsp;</label><input name="password" class="input_field" type="password">
							</p>
							</div>

							<p><a href="javascript:void(0);" onclick="toggle_lightbox('users.php?act=lost_password', 'lost_password_lightbox');" class="forpw">Forgot password?</a> &nbsp; <input type="submit" value="Log In" class="button1" /></p>
					</form>
					<a href="javascript:cerrarmenu()" class="no_sign"></a>

                </div>
				</div>
		
	<?php } ?>		
	</div> 
</div>
	
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
<h1>Statistics</h1>
</center>

<div id="total">
<?php
//PEDIR SOLO PARA EL PENDING

$no = "no";

$sql88 = "SELECT * FROM payments WHERE username ='".$user_id."' AND pagado = '".$no."'";

$consulta88 = mysql_query($sql88); 

$fetch88 = mysql_fetch_array($consulta88);

$pendiente = $fetch88['pending'];




//pedir strtotimehoy

$fechahoy = date('Y-m-j');
$fechaayer = date('Y-m-j');

//convertir fecha hoy en fecha ayer
$fechaayer = strtotime ( '-1 day' , strtotime ( $fechaayer ) ) ;
$fechaayer = date ( 'Y-m-j' , $fechaayer );


$strtotimehoy = strtotime($fechaayer);


$sql23 = "SELECT * FROM reports WHERE user_id ='".$user_id."' order by id DESC limit 1";


// and strtotime ='".$strtotimehoy."' 

$consulta23 = mysql_query($sql23);
$numero = mysql_num_rows($consulta23);


$fetch23 = mysql_fetch_array($consulta23);

$ultimoreport = $fetch23['strtotime'];

$gananciasdeldia = $fetch23['ganancias'];

$totalearnings = $fetch23['gananciastotales'];

$payedbalance = $fetch23['pagado'];

$fecha1 = $fetch23['fecha'];


/*
pedir datos y almacenar var en:

$ganancias = campo ganancias
$a = campo a
...


*/



if($strtotimehoy==$ultimoreport){


//echo "HAY DATOS ACTUALIZADOS HASTA HOY";

$sql = "SELECT payedbalance,realbalance FROM mmh_user_info WHERE user_id ='".$user_id."'";

$consulta = mysql_query($sql); 

$fetch = mysql_fetch_array($consulta);

$payedbalance = $fetch['payedbalance'];

$realbalance = $fetch['realbalance'];

$totalunpaidbalance = $totalearnings - $payedbalance;

$gananciastotales = $totalearnings;


if($totalunpaidbalance!=$realbalance){
$sql85 = "UPDATE mmh_user_info SET realbalance='".mysql_real_escape_string($totalunpaidbalance)."' WHERE user_id='".mysql_real_escape_string($user_id)."'";
$consulta85  = mysql_query($sql85);  


}


}else{

//echo "ENTRA AL ELSE";


$sql99 = "SELECT payedbalance,realbalance FROM mmh_user_info WHERE user_id ='".$user_id."'";

$consulta99 = mysql_query($sql99); 

$fetch99 = mysql_fetch_array($consulta99);

$payedbalance = $fetch99['payedbalance'];

$realbalance = $fetch99['realbalance'];
//seleccionar el ultimo campo (el del ultimo dia q se pidio) de la tabla reports



/*

$sql23 = "SELECT * FROM reports WHERE user_id ='".$user_id."' order by id DESC limit 1";

$consulta23 = mysql_query($sql23);

$numero = mysql_num_rows($consulta23);

*/
	
	if($numero!=0){
	
	
	//echo "HAY DATOS A PARTIR DE ALGUN DIA";
	
	/*

	$fetch23 = mysql_fetch_array($consulta23);

	$lastdatetotime = $fetch23['strtotime'];

	*/
	$gananciastotalesderef = 0;
	
	$gananciastotales = $totalearnings;
	
	$ganaciasdeldiaderef_sumados = 0;
	//obtener la fecha de ese dia

	//$fecha1 = $fetch23['fecha'];

	$fecha1 = strtotime ( '+1 day' , strtotime ( $fecha1 ) ) ;
	$fecha1 = date ( 'Y-m-j' , $fecha1 );
	
	$fecha1totime = strtotime($fecha1); //se obtiene de base de datos


	$fecha2 = $fechahoy; //se obtiene de hoy

	//$fecha1totime = strtotime($fecha1);

	$fecha2totime = strtotime($fecha2);

	
	
	/*
	$fecha1 = $_POST["fecha1"];
	$fecha2 = $_POST["fecha2"];
	*/


	$start    = new DateTime($fecha1);
	$end      = new DateTime($fecha2);
	$interval = new DateInterval('P1D');
	$period   = new DatePeriod($start, $interval, $end);

	foreach ($period as $dt)
	{
		$fecha = $dt->format("Y-m-d");
		//echo $dt->format("Y-m-d"). "<br>";
		
		$a = 0;
		$b = 0;
		$c = 0;
		$d = 0;
		
		
		$fechaarray = explode("-", $fecha);
		$dia = $fechaarray[2];    
		$mes = $fechaarray[1];
		$ano = $fechaarray[0];
		
		$fechatotime = strtotime($fecha);
		//echo $fechatotime."<br>";
		
		$sql =  "SELECT * FROM contador WHERE uploadedby = '".$user_id."' AND strtotime = '".$fechatotime."'";
		$consulta = mysql_query($sql);
		while($row = mysql_fetch_assoc($consulta))
		{
		$elpais = $row['pais'];
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
		
	//YA TENEMOS A,B,C,D y ganancias del dia, ganancias por cada tier. * faltaria lo pagado y lo no pagado

	//conseguir los datos: ganancias del dia, ganancias del dia anterior, lo pagado hasta la fecha, lo total no pagado hasta la fecha, ganancias por cada tier
	//insertar esos datos en la tabla reports y continuar con el dia siguiente.


	/*
	Completar la tabla de reports desde contador,

	Recorrer el primer dia, obtener a,b,c,d multiplicar por ganancias e insertar en reports

	Pasar al siguiente dia y repetir el proceso hasta llegar a la fecha de hoy
	*/

	$visitas = $a + $b + $c + $d;
	$gananciasa = $a * 0.006;
	$gananciasb = $b * 0.0015;
	$gananciasc = $c * 0.00030;
	$gananciasd = $d * 0.00015;

	$ganancias = $gananciasa + $gananciasb + $gananciasc + $gananciasd;
	
	$gananciastotales = $gananciastotales + $ganancias;
	
	$pagado = $payedbalance;
	
	$nopagado = $gananciastotales - $pagado;
	
	$totalunpaidbalance = $nopagado;
	
	$fechatotime = $fechatotime;

	$sql18 = "INSERT INTO reports (dia, mes, ano, fecha, visitas, a, b, c, d, gananciasa, gananciasb, gananciasc, gananciasd, ganancias, gananciastotales, pagado, nopagado, user_id, strtotime) VALUES ('".$dia."', '".$mes."','".$ano."','".$fecha."','".$visitas."','".$a."','".$b."','".$c."','".$d."','".$gananciasa."','".$gananciasb."','".$gananciasc."','".$gananciasd."','".$ganancias."','".$gananciastotales."','".$pagado."','".$nopagado."','".$user_id."','".$fechatotime."')";
	$consulta18  = mysql_query($sql18);    

	

	}}else{

	
	$ganaciasdeldiaderef_sumados = 0;

	$gananciastotales = 0;
	
	$gananciastotalesderef = 0;
	
	//obtener la fecha de ese dia


	$fecha1 = "2014-01-01"; //se obtiene de base de datos o se completa a partir de 2014

	$fecha1totime = strtotime($fecha1);


	$fecha2 = $fechahoy; //se obtiene de hoy

	//$fecha1totime = strtotime($fecha1);

	$fecha2totime = strtotime($fecha2);


	/*
	$fecha1 = $_POST["fecha1"];
	$fecha2 = $_POST["fecha2"];
	*/

	$start    = new DateTime($fecha1);
	$end      = new DateTime($fecha2);
	$interval = new DateInterval('P1D');
	$period   = new DatePeriod($start, $interval, $end);

	foreach ($period as $dt)
	{
		$fecha = $dt->format("Y-m-d");
		//echo $dt->format("Y-m-d"). "<br>";
		
		$a = 0;
		$b = 0;
		$c = 0;
		$d = 0;

		
		$fechaarray = explode("-", $fecha);
		$dia = $fechaarray[2];    
		$mes = $fechaarray[1];
		$ano = $fechaarray[0];
		
		$fechatotime = strtotime($fecha);
		//echo $fechatotime."<br>";
		
		$sql =  "SELECT * FROM contador WHERE uploadedby = '".$user_id."' AND strtotime = '".$fechatotime."'";
		$consulta = mysql_query($sql);
		while($row = mysql_fetch_assoc($consulta))
		{
		$elpais = $row['pais'];
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
		
	//YA TENEMOS A,B,C,D y ganancias del dia, ganancias por cada tier. * faltaria lo pagado y lo no pagado

	//conseguir los datos: ganancias del dia, ganancias del dia anterior, lo pagado hasta la fecha, lo total no pagado hasta la fecha, ganancias por cada tier
	//insertar esos datos en la tabla reports y continuar con el dia siguiente.


	/*
	Completar la tabla de reports desde contador,

	Recorrer el primer dia, obtener a,b,c,d multiplicar por ganancias e insertar en reports

	Pasar al siguiente dia y repetir el proceso hasta llegar a la fecha de hoy
	*/

	$visitas = $a + $b + $c + $d;
	$gananciasa = $a * 0.006;
	$gananciasb = $b * 0.0015;
	$gananciasc = $c * 0.00030;
	$gananciasd = $d * 0.00015;

	$ganancias = $gananciasa + $gananciasb + $gananciasc + $gananciasd;
	
	
	$gananciastotales = $gananciastotales + $ganancias;
	
	$pagado = $payedbalance;
	
	$nopagado = $gananciastotales - $pagado;
	
	
	$totalunpaidbalance = $nopagado;
	
	$fechatotime = $fechatotime;

	$sql18 = "INSERT INTO reports (dia, mes, ano, fecha, visitas, a, b, c, d, gananciasa, gananciasb, gananciasc, gananciasd, ganancias, gananciastotales, pagado, nopagado, user_id, strtotime) VALUES ('".$dia."', '".$mes."','".$ano."','".$fecha."','".$visitas."','".$a."','".$b."','".$c."','".$d."','".$gananciasa."','".$gananciasb."','".$gananciasc."','".$gananciasd."','".$ganancias."','".$gananciastotales."','".$pagado."','".$nopagado."','".$user_id."','".$fechatotime."')";
	$consulta18  = mysql_query($sql18);    


	
	}








	}}
?>


<br>
<div class="rightnav">
<label><b>&nbsp;&nbsp;&nbsp;Total Unpaid Balance ($): </b><?php echo $totalunpaidbalance;?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><b>Total Payout ($): </b><?php echo $payedbalance;?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><b>Pending Payments ($): </b><?php echo $pendiente;?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label><b>Total Earned ($): </b><?php echo $gananciastotales;?></label>

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


$fecha22 = $anohoy."-".$meshoy."-".$diaman;
//


//$fecha2 = date('Y-m-j');



$fecha22totime = strtotime($fecha22);


$fecha11 = strtotime ( '-10 day' , strtotime ( $fecha22 ) ) ;
$fecha11 = date ( 'Y-m-j' , $fecha11 );

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
User ID:<input type="text" name="user_id" id="user_id"></input>
<br>
<br>
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
		<th style="font-size:12px; background-color: #981919"></th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #981919">Zone A</th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #981919">Zone B</th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #981919">Zone C</th>
		<th class="center" colspan="2" style="font-size:12px; background-color: #981919">Zone D</th>
		<th colspan="2" class="center" style="font-size:12px; background-color: #981919">Total</th>
	</tr>
	<tr>
	<th style="font-size:12px; background-color: #981919">Date</th>
	<th style="font-size:12px; background-color: #981919">Views</th>
	<th style="font-size:12px; background-color: #981919">Earnings</th>
	<th style="font-size:12px; background-color: #981919">Views</th>
	<th style="font-size:12px; background-color: #981919">Earnings</th>
	<th style="font-size:12px; background-color: #981919">Views</th>
	<th style="font-size:12px; background-color: #981919">Earnings</th>
	<th style="font-size:12px; background-color: #981919">Views</th>
	<th style="font-size:12px; background-color: #981919">Earnings</th>
	<th style="font-size:12px; background-color: #981919">Views</th>
	<th style="font-size:12px; background-color: #981919">Earnings</th>
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
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['visitas'];?></th>
			<th style="background-color:#f0f0f0; color: black; font-size:12px;"><?php echo $resEmp['ganancias'];?></th>
			</tr>
			
		   <?
		   $gananciasperiodo = $gananciasperiodo + $resEmp['ganancias'];
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
 
		<th colspan="2" style="font-size:12px; background-color: #981919">Total: $<?php echo $gananciasperiodo;?></th>
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
	
	<div style="position: absolute;height: 12px;line-height: 13px;padding: 0 6px;background: #ffcc00;color: #111;margin-left: 220px;margin-top: -1px;border-radius: 10px;font-size: 10px;font-weight: bold;font-family: Arial,sans-serif;text-shadow: 0 1px 0 rgba(255,255,255,0.3);box-shadow: inset 0 1px 0 rgba(255,255,255,0.3), 0 1px 0 rgba(0,0,0,0.5);" name="newws">	
	Statistics are updated only once a day (tomorrow you will see today's earnings), Server time:
	<div id="hora"></div>
	</div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>

</div>
    	
	<div id="footer_cell" class="footer_cell">
	
	<table align="center" border="0" cellpadding="1" cellspacing="0" width="100%">
  <tbody>
  <tr>	
  
  				<td align="left">
			<a class="footer-content" href="./">Home</a>  | 
			<a class="footer-content" href="/dmca">Report abuse</a>  |  
			<a class="footer-content" href="/tos">ToS</a>  |
			<a class="footer-content" href="/privacy">Privacy policy</a> |
			<a class="footer-content" href="/faq">FAQ</a> |
			<a class="footer-content" href="/contact_us">Contact</a>

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