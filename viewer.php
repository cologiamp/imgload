<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251327647 - Wednesday, August 26, 2009, 07:00:47 PM EDT -0400
	// ======================================== /
	include("siteinfo.php");
	require_once "./source/includes/data.php";
	require("configuracion.php");
	require_once "{$mmhclass->info->root_path}source/language/viewer.php";
	session_start();
	
	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);
	
	if ($mmhclass->funcs->is_null($mmhclass->input->get_vars['file']) == true) {
		$mmhclass->templ->error($mmhclass->lang['002'], true);
	} elseif ($mmhclass->funcs->is_file($mmhclass->input->get_vars['file'], $mmhclass->info->root_path.$mmhclass->info->config['upload_path'], true) == false) {
		$mmhclass->templ->error(sprintf($mmhclass->lang['003'], $mmhclass->image->basename($mmhclass->input->get_vars['file'])), true);
	} elseif ($mmhclass->image->is_image($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$mmhclass->input->get_vars['file']) == false) {
		$mmhclass->templ->error(sprintf($mmhclass->lang['004'], $mmhclass->image->basename($mmhclass->input->get_vars['file'])), true);
	} else {
		$filename = $mmhclass->image->basename($mmhclass->input->get_vars['file']);
		
		$file_info = $mmhclass->image->get_image_info($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$filename);
		$file_logs = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `[1]` WHERE `filename` = '[2]' LIMIT 1;", array(MYSQL_FILE_LOGS_TABLE, $filename)));
		$file_sinfo = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `[1]` WHERE `filename` = '[2]' LIMIT 1;", array(MYSQL_FILE_STORAGE_TABLE, $filename)));
		$rating_info = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `[1]` WHERE `filename` = '[2]' LIMIT 1;", array(MYSQL_FILE_RATINGS_TABLE, $filename)));
		
		$familysafe = $file_sinfo['is_private'];

		if ($mmhclass->funcs->is_null($mmhclass->input->server_vars['http_referer']) == false && stripos($mmhclass->input->server_vars['http_referer'], $mmhclass->info->base_url) === false) {
			$new_viewer_click = $mmhclass->db->query("UPDATE `[1]` SET `viewer_clicks` = `viewer_clicks` + 1 WHERE `filename` = '[2]';", array(MYSQL_FILE_STORAGE_TABLE, $filename));
		}
		
		if ($mmhclass->input->get_vars['act'] == "rate_it" && $mmhclass->funcs->is_null($mmhclass->input->post_vars['rating_id']) == false) {
			$mmhclass->templ->templ_globals['new_file_rating'] = true;
			
			if (in_array($mmhclass->input->server_vars['remote_addr'], explode("|", $rating_info['voted_by'])) == true) {
				$new_rating_html = $failed_image_rating = $mmhclass->templ->error($mmhclass->lang['005'], false);
			} else {
				if ($mmhclass->funcs->is_null($rating_info['rating_id']) == true) {
					$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `total_rating`, `total_votes`, `voted_by`) VALUES ('[2]', '0', '0', '');", array(MYSQL_FILE_RATINGS_TABLE, $filename));
				}
				
				$mmhclass->db->query("UPDATE `[1]` SET `total_rating` = `total_rating` + '[2]', `total_votes` = `total_votes` + 1, `voted_by` = '[3]' WHERE `filename` = '[4]';", array(MYSQL_FILE_RATINGS_TABLE, $mmhclass->input->post_vars['rating_id'], "{$rating_info['voted_by']}|{$mmhclass->input->server_vars['remote_addr']}", $filename));
				
				$new_rating_html = $mmhclass->templ->message(sprintf($mmhclass->lang['006'], $filename), false);
			}
		}
		
		$mmhclass->templ->templ_globals['file_info'] = $file_info;
		$image_size = $mmhclass->image->scaleby_maxwidth($filename, 940);
		
		$mmhclass->templ->templ_globals['familysafe'] = $familysafe;
		
		
		$mmhclass->templ->templ_vars[] = array(
			 "FAMILYSAFE" => $familysafe,
			 "FILENAME" => $filename,
			 "MIME_TYPE" => $file_info['mime'],
			 "IMAGE_WIDTH" => $file_info['width'],
			 "NEW_RATING_HTML" => $new_rating_html,
			 "IMAGE_HEIGHT" => $file_info['height'],
			 "HIDDEN_COMMENT" => $file_info['comment'],
			 "UPLOAD_PATH" => $mmhclass->info->config['upload_path'],
			 "FILE_LINKS" => $mmhclass->templ->file_results($filename),
			 "FILE_EXTENSION" => $mmhclass->image->file_extension($filename),
			 "TOTAL_FILESIZE" => $mmhclass->image->format_filesize($file_info['bits']),
			 "DATE_UPLOADED" => date($mmhclass->info->config['date_format'], $file_info['mtime']),
			 "REAL_FILENAME" => (($mmhclass->funcs->is_null($file_logs['original_filename']) == false) ? $file_logs['original_filename'] : $filename),		
			 "IMAGE_RESIZE" => (($mmhclass->funcs->is_null($image_size['h']) == false) ? "width: {$image_size['w']}px; height: {$image_size['h']}px;" : NULL),
			 "VIEWER_CLICKS" => $mmhclass->funcs->format_number(($new_viewer_click == false) ? $file_sinfo['viewer_clicks'] : ($file_sinfo['viewer_clicks'] + 1)),
			 "TOTAL_RATINGS" => $mmhclass->funcs->format_number((isset($new_rating_html) == true && isset($failed_image_rating) == false) ? ($rating_info['total_votes'] + 1) : $rating_info['total_votes']),
	  	);
		if($_SESSION["visito"]!=1 AND $_SESSION["visito"]!=2){
		$_SESSION["comefrom"] = $_SERVER['HTTP_REFERER'];
		$_SESSION["visito"]=1;
		?>
		<html>
		<head>
		 
		<meta name="version" content="ImgWolf" />
		<meta name="description" content="ImgWolf.com is a simple image hosting." />		
		<meta name="keywords" content="image hosting, image hosting service, multiple image hosting, unlimited bandwidth, 
		quick image hosting, image, picture, hosting, screenshots, photos, photo, share, share images,
		share photos, share with friends, social, networking, free, unlimited	" />
		<link rel="shortcut icon" href="./css/images/favicoc.ico" />
		<link href="http://imgwolf.com/images/<?echo $filename;?>" rel="image_src" />


		<script type="text/javascript" src="source/includes/scripts/jquery.js"></script>
		<script type="text/javascript" src="source/includes/scripts/genjscript.js"></script>
		<script type="text/javascript" src="source/includes/scripts/phpjs_00029.js"></script>
		<script type="text/javascript" src="source/includes/scripts/jquery.jdMenu.js"></script>
		<script type="text/javascript" src="source/includes/scripts/jquery.bgiframe.js"></script>
		<script type="text/javascript" src="source/includes/scripts/jquery.positionBy.js"></script>
		<script type="text/javascript" src="source/includes/scripts/jquery.dimensions.js"></script>
		<script type="text/javascript" src="/js/maxlines.js"></script>
		

		
		<!-- Start JuicyAds Mobile -->
		<script type="text/javascript" src="http://js.juicyads.com/jam_min.js"></script>
		<script type="text/javascript">window.onload=check_mobile(77547,148055)</script>
		<!-- End JuicyAds Mobile -->


		<!-- POPUP ADULT -->
		
		<script type="text/javascript">
		var uid = '77931';
		var wid = '147480';
		</script>
		<script type="text/javascript" src="http://cdn.popcash.net/pop.js"></script>


		<!-- Begin JuicyAds PopUnder Code -->

		<!-- End JuicyAds PopUnder Code -->
	
	
		<!-- POPUP ADULT -->
					
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-68771967-1', 'auto');
		  ga('send', 'pageview');

		</script>

		
		<title><?php echo $siteinfo_title;?> - Download <?php echo $file_logs['original_filename'];?></title>

		<script type="text/javascript" src="source/includes/scripts/jquery.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			setTimeout(function() {
				$(".content1").fadeOut(1500);
			},6000);
		});
		</script>
		<script type="text/javascript" src="../jquery.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {   
			setTimeout(function() {
				$(".content2").fadeIn(1500);
			},7500);
		});
		</script>


		
		<style type="text/css">
		div.cti {
			color: black;
			margin-left: 20px;
			width: 616px;
			overflow: hidden;
			height: 77px;
			position: relative;
		}

		div.left-cti {
			float: left;
			width: 145px;
			height: 30px;
			background-image: url('css/images/cti-button-left.png');
			margin-top: 16px;
			padding-top: 15px;
			color: black;
		}

		div.left-cti a {
			font-size: 13px;
			text-decoration: none;
			color: #000;
			font-weight: bold;
			color: black;
		}
		
		div.left-cti-loading {
			color: black;
			float: left;
			width: 145px;
			height: 30px;
			background-image: url('css/images/cti-button-left-loading.png');
			margin-top: 16px;
			padding-top: 15px;
		}
		input.cti-submit {
			color: black;
			display: block;
			float: left;
			width: 154px;
			height: 45px;
			margin-top: 16px;
			background-image: url('css/images/cti-button.png');
			border: 0;
			cursor: pointer;
		}
		
		input.cti-submit:hover {
			background-image: url('css/images/cti-button.png');
		}
		
		
		input.cti-submit-loading {
			display: block;
			float: left;
			width: 154px;
			height: 45px;
			margin-top: 16px;
			background-image: url('css/images/cti-button-loading.png');
			border: 0;
			cursor: default;
			color: black;
		}
		
		input.cti-submit-loading:hover {
			background-image: url('css/images/cti-button-loading.png');
			cursor: default;
			margin-top: 16px;
			color: black;
		}

		div.right-cti {
			float: left;
			width: 159px;
			height: 30px;
			background-image: url('css/images/cti-button-right.png');
			margin-top: 16px;
			padding-top: 15px;
			color: black;
			}
		</style>



		</head>

		<body bgcolor="#FFFFFF">


		<div class="content1">

		<label style="color:red; font-size: 25px; font-family: Microsoft Sans Serif;">
		Please wait loading...
		</label>

		
		
		</div>
		
		<div class="content2" style="display:none;">
		
		<form method="post" action="viewer.php?file=<?php echo $filename;?>">
		
		<input type="hidden" value="clic" name="clic"/>

		
		<input  type="submit" style="font-size: 25px; color: red; border: 0; background: white; cursor: pointer;" rel="nofollow" value='Continue to your image'/>
		
		</form>
		
		
		</div>
		<br/>
		

		
		
		<div align="center" style="overflow: hidden;">
		
		<?php if($familysafe==1){ ?>
		
		<!-- BEGIN Ad Tag -->
		<!--Iframe Tag  -->
		<!-- begin ZEDO for channel:  ImgWolf.com , publisher: ImgWolf.com , Ad Dimension: 600x330 - 600 x 330 -->

		<!-- end ZEDO for channel:  ImgWolf.com , publisher: ImgWolf.com , Ad Dimension: 600x330 - 600 x 330 -->
		<!-- END Ad Tag -->


		<?php }else{?>
		
		<!-- BEGIN OF BIG ADULT -->	

		<!-- END OF BIG ADD ADULT -->
		
		<?php } ?>
		</div>
		
		</body>
		</html>
		<?php
		//$mmhclass->templ->output("viewer", "viewer_filter");
		}else if($_SESSION["visito"]=="1"){
		require("conexion.php");
		require("configuracion.php");
		$_SESSION["visito"]=2;
		if($_SESSION["comefrom"]==""){
		
		
		mysql_select_db($db,$conexion)or die (mysql_error());
		/*
		$sql = "INSERT INTO contador (id, imagen)";
		$sql.= "VALUES ('','$filename')";
		*/
		$sql = "SELECT file_id, gallery_id, file_title FROM mmh_file_storage WHERE filename  ='".mysql_real_escape_string($filename)."'";

		$consulta  = mysql_query($sql); 

		$fetch = mysql_fetch_array($consulta);

		$file_id = $fetch['file_id'];
		$gallery_id = $fetch['gallery_id'];
		$file_title = $fetch['file_title'];

		function getRealIP()
		{
		 
		   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
		   {
			  $client_ip = 
				 ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
					$_SERVER['REMOTE_ADDR'] 
					: 
					( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
					   $_ENV['REMOTE_ADDR'] 
					   : 
					   "unknown" );
		 
			  // los proxys van añadiendo al final de esta cabecera
			  // las direcciones ip que van "ocultando". Para localizar la ip real
			  // del usuario se comienza a mirar por el principio hasta encontrar 
			  // una dirección ip que no sea del rango privado. En caso de no 
			  // encontrarse ninguna se toma como valor el REMOTE_ADDR
		 
			  $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);
		 
			  reset($entries);
			  while (list(, $entry) = each($entries)) 
			  {
				 $entry = trim($entry);
				 if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
				 {
					// http://www.faqs.org/rfcs/rfc1918.html
					$private_ip = array(
						  '/^0\./', 
						  '/^127\.0\.0\.1/', 
						  '/^192\.168\..*/', 
						  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
						  '/^10\..*/');
		 
					$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
		 
					if ($client_ip != $found_ip)
					{
					   $client_ip = $found_ip;
					   break;
					}
				 }
			  }
		   }
		   else
		   {
			  $client_ip = 
				 ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
					$_SERVER['REMOTE_ADDR'] 
					: 
					( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
					   $_ENV['REMOTE_ADDR'] 
					   : 
					   "unknown" );
		   }
		 
		   return $client_ip;
		   
		 
		}  
		//se requiere el archivo para validar los datos de usuario de bdd para conectar
		$IP = getRealIP();
		$fecha = date("j del n de Y");
		$hora = date("h:i:s");
		$segundos = time();
		$can = "86400";
		$resta = $segundos-$can;
		//se asignan la variables
		$sql = "SELECT segundos, IP ";
		$sql.= "FROM contador_bots WHERE segundos >= $resta AND IP LIKE '$IP' ";
		$es = mysql_query($sql, $con) or die("Error al leer base de datos: ".mysql_error);
		//se buscan los registros que num de seg mayor a num de seg hace una hora e IP
		if(mysql_num_rows($es)>0)
		{//no se cuenta la visita
		}
		else
		{

		$dia = date("d");
		$mes = date("m");
		$ano = date("y");
		$fecha1 = $ano.$mes.$dia;

		/*
		$sql = "INSERT INTO contador (id, IP, fecha, hora, segundos, pais, imagen, uploadedby,dia,mes,ano)";
		$sql.= "VALUES ('','$IP','$fecha1','$hora','$segundos','$ippais','$nombre','$username','$dia','$mes','$ano')";
		$es = mysql_query($sql, $con) or die("Error al grabar un mensaje: ".mysql_error);
		$file_id = $fetch['file_id'];
		$gallery_id = $fetch['gallery_id'];
		$file_title = $fetch['file_title'];
		*/

		// Incluimos la librería 
		include("Geo/geoip.inc"); 
		// Abrimos el localizador indicando 
		// el archivo de datos y el método 
		$gi = geoip_open("Geo/GeoIP.dat",GEOIP_STANDARD); 
		// Resolvemos la direccion IP 
		$ipreq = $IP;
		// Resolvemos y mostramos el país 
		$ippais = geoip_country_code_by_addr($gi, $ipreq); 
		// Cerramos el localizador 
		geoip_close($gi); 

		$datee = date("y-m-d");
		$strtodatee = strtotime($datee);
		$sql = "INSERT INTO contador_bots (IP, hora, fecha, segundos, imagen, pais, uploadedby, dia, mes, ano, strtotime, file_title, comefrom) VALUES ('".$IP."','".$hora."','".$fecha1."','".$segundos."','".$filename."','".$ippais."','".$gallery_id."','".$dia."','".$mes."','".$ano."','".$strtodatee."','".$file_title."','".$_SESSION["comefrom"]."')";
		$es = mysql_query($sql, $con) or die("Error please refresh 2".mysql_error);

		
		
		}
		}
		if($_POST["clic"]=="clic" AND $_SESSION["comefrom"]!=""){
		mysql_select_db($db,$conexion)or die (mysql_error());
		/*
		$sql = "INSERT INTO contador (id, imagen)";
		$sql.= "VALUES ('','$filename')";
		*/
		$sql = "SELECT file_id, gallery_id, file_title FROM mmh_file_storage WHERE filename  ='".mysql_real_escape_string($filename)."'";

		$consulta  = mysql_query($sql); 

		$fetch = mysql_fetch_array($consulta);

		$file_id = $fetch['file_id'];
		$gallery_id = $fetch['gallery_id'];
		$file_title = $fetch['file_title'];

		function getRealIP()
		{
		 
		   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
		   {
			  $client_ip = 
				 ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
					$_SERVER['REMOTE_ADDR'] 
					: 
					( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
					   $_ENV['REMOTE_ADDR'] 
					   : 
					   "unknown" );
		 
			  // los proxys van añadiendo al final de esta cabecera
			  // las direcciones ip que van "ocultando". Para localizar la ip real
			  // del usuario se comienza a mirar por el principio hasta encontrar 
			  // una dirección ip que no sea del rango privado. En caso de no 
			  // encontrarse ninguna se toma como valor el REMOTE_ADDR
		 
			  $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);
		 
			  reset($entries);
			  while (list(, $entry) = each($entries)) 
			  {
				 $entry = trim($entry);
				 if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
				 {
					// http://www.faqs.org/rfcs/rfc1918.html
					$private_ip = array(
						  '/^0\./', 
						  '/^127\.0\.0\.1/', 
						  '/^192\.168\..*/', 
						  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
						  '/^10\..*/');
		 
					$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
		 
					if ($client_ip != $found_ip)
					{
					   $client_ip = $found_ip;
					   break;
					}
				 }
			  }
		   }
		   else
		   {
			  $client_ip = 
				 ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
					$_SERVER['REMOTE_ADDR'] 
					: 
					( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
					   $_ENV['REMOTE_ADDR'] 
					   : 
					   "unknown" );
		   }
		 
		   return $client_ip;
		   
		 
		}  
		//se requiere el archivo para validar los datos de usuario de bdd para conectar
		$IP = getRealIP();
		$fecha = date("j del n de Y");
		$hora = date("h:i:s");
		$segundos = time();
		$can = "86400";
		$resta = $segundos-$can;
		//se asignan la variables
		$sql = "SELECT segundos, IP ";
		$sql.= "FROM contador WHERE segundos >= $resta AND IP LIKE '$IP' ";
		$es = mysql_query($sql, $con) or die("Error al leer base de datos: ".mysql_error);
		//se buscan los registros que num de seg mayor a num de seg hace una hora e IP
		if(mysql_num_rows($es)>0)
		{//no se cuenta la visita
		}
		else
		{

		$dia = date("d");
		$mes = date("m");
		$ano = date("y");
		$fecha1 = $ano.$mes.$dia;

		/*
		$sql = "INSERT INTO contador (id, IP, fecha, hora, segundos, pais, imagen, uploadedby,dia,mes,ano)";
		$sql.= "VALUES ('','$IP','$fecha1','$hora','$segundos','$ippais','$nombre','$username','$dia','$mes','$ano')";
		$es = mysql_query($sql, $con) or die("Error al grabar un mensaje: ".mysql_error);
		$file_id = $fetch['file_id'];
		$gallery_id = $fetch['gallery_id'];
		$file_title = $fetch['file_title'];
		*/

		// Incluimos la librería 
		include("Geo/geoip.inc"); 
		// Abrimos el localizador indicando 
		// el archivo de datos y el método 
		$gi = geoip_open("Geo/GeoIP.dat",GEOIP_STANDARD); 
		// Resolvemos la direccion IP 
		$ipreq = $IP;
		// Resolvemos y mostramos el país 
		$ippais = geoip_country_code_by_addr($gi, $ipreq); 
		// Cerramos el localizador 
		geoip_close($gi); 

		$datee = date("y-m-d");
		$strtodatee = strtotime($datee);
		
		
		$sql = "INSERT INTO contador (IP, hora, fecha, segundos, imagen, pais, uploadedby, dia, mes, ano, strtotime, file_title, comefrom) VALUES ('".$IP."','".$hora."','".$fecha1."','".$segundos."','".$filename."','".$ippais."','".$gallery_id."','".$dia."','".$mes."','".$ano."','".$strtodatee."','".$file_title."','".$_SESSION["comefrom"]."')";
		$es = mysql_query($sql, $con) or die("Error please refresh 1: ");
		


		$sql4 = "SELECT viewer_unique_clicks FROM mmh_file_storage WHERE filename ='".mysql_real_escape_string($filename)."'";

		$consulta4  = mysql_query($sql4); 

		$fetch4 = mysql_fetch_array($consulta4);

		$views = $fetch4['viewer_unique_clicks'];

		$views = $views+1;

		$sql15 = "UPDATE mmh_file_storage SET viewer_unique_clicks ='".mysql_real_escape_string($views)."' WHERE filename='".mysql_real_escape_string($filename)."'"; 
		$consulta15  = mysql_query($sql15); 
		}}
		$mmhclass->templ->output("viewer","viewer_image");
		
		}else if($_SESSION["visito"]==2){
				$mmhclass->templ->output("viewer","viewer_image2");		
		}
	}
	
?>