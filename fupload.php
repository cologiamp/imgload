<?php
require("conexion.php");
require("miniatura.php");
require_once "source/includes/data.php";
require_once "{$mmhclass->info->root_path}source/language/upload.php";

//OBTENER IP

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
$ipp = getRealIP();




// Code for to workaround the Flash Player Session Cookie bug
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	} else if (isset($_GET["PHPSESSID"])) {
		session_id($_GET["PHPSESSID"]);
	}

	session_start();
	$microtime = $_SESSION['microtime'];
	//$user_id = $_SESSION['user_id'];
	//COMIENZA NUEVO USERID
	if ($mmhclass->info->is_user == true) {
			$user_id = $mmhclass->info->user_data['user_id'];
			$_SESSION['user_id'] = $user_id;
			}else{
			$user_id = "0";
			$_SESSION['user_id'] = $user_id;
			}
	//FIN NUEVO USER ID
	$size = $_POST["thumbsize"];
// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
		header("HTTP/1.1 500 Internal Server Error"); // This will trigger an uploadError event in SWFUpload
		echo "El envio a excedido el tamaño maximo permitido.";
		exit(0);
	}

// Settings
	$save_path = dirname(__FILENAME__) . "/images/";				// The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)
	$upload_name = "Filedata";
	$max_file_size_in_bytes = 31457280;				// 2GB in bytes
	$extension_whitelist = array("jpg", "gif", "png");	// Allowed file extensions
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';				// Characters allowed in the file name (in a Regular Expression format)
	
// Other variables	
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$file_extension = "";
	$uploadErrors = array(
        0=>"Este no es un error, el archivos a terminado de subir.",
        1=>"El archivo cargado excede el tamaño establecido en la directiva upload_max_filesize de php.ini",
        2=>"El archivo cargado excede el tamaño establecido en la directiva MAX_FILE_SIZE que esta especificado en el formulario HTML",
        3=>"El archivo esta temporalmente en carga",
        4=>"El archivo no esta cargado",
        6=>"Se perdio el archivo temporalmente"
	);


// Validate the upload
	if (!isset($_FILES[$upload_name])) {
		HandleError("Carga no encontrada en \$_FILES para " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
		HandleError("Carga fallada en la prueba de is_uploaded_file .");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'])) {
		HandleError("Archivo no tiene nombre.");
		exit(0);
	}
	
// Validate the file size (Warning: the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("El archivo excede el maximo permitido");
		exit(0);
	}
	
	if ($file_size <= 0) {
		HandleError("El tamaño del archivo esta fuera de los limites");
		exit(0);
	}


// Validate file name (for our purposes we'll just remove invalid characters)
	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
	
//mi file name
	$filetitle = strip_tags((strlen($file_name) > 20) ? sprintf("%s...", substr($file_name, 0, 20)) : $file_name);
	$file_name = sprintf("%s.%s", $mmhclass->funcs->random_string(20, "0123456789"), ($extension = $mmhclass->image->file_extension($file_name)));
							
	
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
		HandleError("Nombre de archivo invalido");
		exit(0);
	}


// Validate that we won't over-write an existing file
	if (file_exists($save_path . $file_name)) {
		HandleError("Archivo con este nombre ya existe.");
		exit(0);
	}

// Validate file extension
	$path_info = pathinfo($_FILES[$upload_name]['name']);
	$file_extension = $path_info["extension"];
	$is_valid_extension = false;
	foreach ($extension_whitelist as $extension) {
		if (strcasecmp($file_extension, $extension) == 0) {
			$is_valid_extension = true;
			break;
		}
	}
	if (!$is_valid_extension) {
		HandleError("Extencion de archivo invalido.");
		exit(0);
	}

// Validate file contents (extension and mime-type can't be trusted)
	/*
		Validating the file contents is OS and web server configuration dependant.  Also, it may not be reliable.
		See the comments on this page: http://us2.php.net/fileinfo
		
		Also see http://72.14.253.104/search?q=cache:3YGZfcnKDrYJ:www.scanit.be/uploads/php-file-upload.pdf+php+file+command&hl=en&ct=clnk&cd=8&gl=us&client=firefox-a
		 which describes how a PHP script can be embedded within a GIF image file.
		
		Therefore, no sample code will be provided here.  Research the issue, decide how much security is
		 needed, and implement a solution that meets the need.
	*/


// Process the file
	/*
		At this point we are ready to process the valid file. This sample code shows how to save the file. Other tasks
		 could be done such as creating an entry in a database or generating a thumbnail.
		 
		Depending on your server OS and needs you may need to set the Security Permissions on the file after it has
		been saved.
	*/
	

	
	if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$file_name)) {
		HandleError("Archivo no puede ser guardado.");
		exit(0);
	}
	
	$filename_array = explode(".",$file_name);
	$filename_thumb = $filename_array[0]."_thumb.".$filename_array[1];
	crear_Thumbnail("images/".$file_name, $size, $size, 90, "images/".$filename_thumb);
	$private = 0;
	$album = 0;
	
	$sql3 = "INSERT INTO mmh_file_storage (filename, filename_thumb, is_private, gallery_id, file_title, album_id, microtime, ip) VALUES ('".$file_name."', '".$filename_thumb."', '".$private."', '".$user_id."','".$filetitle."','".$album."','".$microtime."','".$ipp."')";
	$consulta3  = mysql_query($sql3);
	exit(0);
/** y esta parte esta reservada para que se puede guardar en la base de datos **/
	
																								

/* Fin de la consulta en la base de datos*/
/* Handles the error output. This error message will be sent to the uploadSuccess event handler.  The event handler
will have to check for any error messages and react as needed. */
header("location:shower.php");
function HandleError($message) {
	echo $message;
}
?>