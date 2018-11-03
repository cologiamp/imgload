<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251315122 - Wednesday, August 26, 2009, 03:32:02 PM EDT -0400
	// ======================================== /
	
	function error_handler($number, $error, $file, $line)
	{
		if ($number !== E_NOTICE) {
			$error_types = array(
				E_WARNING => "Warning",
				E_ERROR => "Fatal Error",
				E_STRICT => "Strict Notice",
				E_USER_ERROR => "User Error",
				E_USER_NOTICE => "User Notice",
				E_USER_WARNING => "User Warning",
			);
			
			$error_message = "====================================================================\n";
			$error_message .= sprintf("Time Encountered: %s\n", date("F j, Y, g:i:s A"));
			$error_message .= sprintf("Error Type: %s\n", ((array_key_exists($number, $error_types) == true) ? "{$error_types[$number]} (Error #{$number})" : "Unknown Error (Error #{$number})"));
			$error_message .= sprintf("Error String: %s\n", $error);
			$error_message .= sprintf("Error File: %s\n", $file);
			$error_message .= sprintf("Error Line: %s\n", $line);
			$error_message .= "====================================================================\n";
			
			if ($error_fileh = fopen(sprintf("%ssource/errorlog/php5/%s.log", ROOT_PATH, date("m-d-Y")), "ab")) {
				fwrite($error_fileh, $error_message);
			}
			
			if ($number == E_ERROR) {				
				output_fatal_error("PHP Fatal Error");
			}
		}
		
		return true;
	}
		
	function shutdown_error_handler() 
	{ 
		if (is_null($error = error_get_last()) === false) { 
			error_handler($error['type'], $error['message'], $error['file'], $error['line']);
		}
	} 
	
	function output_fatal_error($errtype) 
	{
		exit("\t\t\t<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
		<html>
			<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
				<title>{$errtype} (Powered by ImgPizza)</title>
				<style type=\"text/css\">
					* { margin: 0; padding: 0; }
					body { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; margin: 10px; background: #FFFFFF; color: #000000; }
					a:link, a:visited { text-decoration: none; color: #005fa9; background-color: transparent; }
					a:active, a:hover { text-decoration: underline; }						
					textarea { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; border: 1px dashed #000000; background: #FFFFFF; padding: 5px; background: #f4f4f4; }
				</style>
			</head>
			<body>
				<p>
					<h2>{$errtype}</h2><br />
					The requested page could not be loaded because a fatal error has occurred. <br />
					Sometimes this error is temporary and will go away when you refresh the page.  
					<br /><br />
					You can try to refresh the page by clicking <a href=\"javascript:void(0);\" onclick=\"window.location.reload();\">here</a>.
					<br /><br />
					If this error page continues to appear after refreshing, then try<br />
					contacting the server administrator at: <a href=\"mailto:{$_SERVER['SERVER_ADMIN']}\">{$_SERVER['SERVER_ADMIN']}</a>.
				</p>		
			</body>
		</html>"); 	
	}

?>