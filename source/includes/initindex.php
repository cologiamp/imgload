<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251372988 - Thursday, August 27, 2009, 07:36:28 AM EDT -0400
	// ======================================== /
	
	/* mysterious settings */
	
	$mmhclass->info->language_files = array(
		1 => "admin.php", 
		2 => "contact.php",
		3 => "download.php", 
		4 => "gallery.php",
		5 => "home.php", 
		6 => "info.php", 
		7 => "install.php",
		8 => "links.php", 
		9 => "tools.php", 
		10 => "upload.php",
		11 => "users.php", 
		12 => "viewer.php", 
		13 => "core/data.php",
		14 => "core/imagemagick.php", 
		15 => "core/template.php",
		16 => "modules/fileinfo.php",
		17 => "statistics.php",
		18 => "flash.php",
		19 => "payments.php",
	);
	
	$mmhclass->info->template_files = array(
		1 => "contact.tpl",
		2 => "fileinfo.tpl",
		3 => "gallery.tpl",
		4 => "global.tpl",
		5 => "home.tpl",
		6 => "info.tpl",
		7 => "install.tpl",
		8 => "page_footer.tpl",
		9 => "page_header.tpl",
		10 => "tools.tpl",
		11 => "upload.tpl",
		12 => "users.tpl",
		13 => "viewer.tpl",
		14 => "admin/admin.tpl",
		15 => "admin/page_header.tpl",
		16 => "admin/page_footer.tpl",
		17 => "statistics.tpl",
		18 => "payments.tpl",
	);
	
	define("LOG_ROBOTS", true);
	
	define("DEFAULT_TIME_ZONE", "GMT");	
	define("GZHANDLER_COMPRESSION_LEVEL", 9);	
	
	define("ENABLE_TEMPLATE_TIDY_HTML", false);
	
	define("USE_GD_LIBRARY", extension_loaded("gd"));
	define("USE_GD2_LIBRARY", extension_loaded("gd2"));
	define("USE_CURL_LIBRARY", extension_loaded("curl"));
	define("USE_MYSQL_LIBRARY", extension_loaded("mysql"));
	define("USE_IMAGICK_LIBRARY", extension_loaded("imagick"));
	
	define("FILTERS_AVAILABLE", function_exists("filter_var"));
	define("EXIF_IS_AVAILABLE", function_exists("exif_imagetype"));
	
	define("DEFAULT_RANDOM_CHARS_LIST", "abcdefghijklmnopqrstuvwxyz0123456789");
	define("DEFAULT_ALLOWED_CHARS_LIST", "-_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
				
	define("MYSQL_DEFAULT_CONNECT_PORT", 3306);		
	define("MYSQL_DEFAULT_CONNECT_HOST", "localhost");	
				
	define("MYSQL_FILE_LOGS_TABLE", "mmh_file_logs");
	define("MYSQL_USER_INFO_TABLE", "mmh_user_info");
	define("MYSQL_SITE_CACHE_TABLE", "mmh_site_cache");
	define("MYSQL_ROBOT_INFO_TABLE", "mmh_robot_info");
	define("MYSQL_ROBOT_LOGS_TABLE", "mmh_robot_logs");
	define("MYSQL_BAN_FILTER_TABLE", "mmh_ban_filter");
	define("MYSQL_ADMIN_CACHE_TABLE", "mmh_admin_cache");
	define("MYSQL_FILE_RATINGS_TABLE", "mmh_file_ratings");
	define("MYSQL_FILE_STORAGE_TABLE", "mmh_file_storage");
	define("MYSQL_SITE_SETTINGS_TABLE", "mmh_site_settings");
	define("MYSQL_USER_SESSIONS_TABLE", "mmh_user_sessions");
	define("MYSQL_GALLERY_ALBUMS_TABLE", "mmh_gallery_albums");
	define("MYSQL_USER_PASSWORDS_TABLE", "mmh_user_passwords");
	
?>