<?php
	// ======================================== \
	// Package: Mihalism Multi Host
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251330795 - Wednesday, August 26, 2009, 07:53:15 PM EDT -0400
	// ======================================== /
	
	require_once "./source/includes/data.php";
	require_once "{$mmhclass->info->root_path}source/language/install.php";

	$mmhclass->templ->page_title = $mmhclass->lang['001'];
	
	if ($mmhclass->info->site_installed == true) {
		$mmhclass->templ->error($mmhclass->lang['002'], true);
	}
	
	switch ($mmhclass->input->get_vars['act']) {
		case "install":
			$mmhclass->templ->templ_vars[] = array(
				"MMH_VERSION" => $mmhclass->info->version,
				"SERVER_ADMIN" => $mmhclass->input->server_vars['server_admin'],
				"EMAIL_OUT" => "noreply@{$mmhclass->input->server_vars['http_host']}",
				"MYSQL_USER" => (($username = get_current_user()) ? $username : "mihalism"),
			);
			
			$mmhclass->templ->output("install", "install_form_page");
			break;
		case "install-d":
			if ($mmhclass->funcs->is_null($mmhclass->input->post_vars['username']) == true || $mmhclass->funcs->is_null($mmhclass->input->post_vars['password']) == true || $mmhclass->funcs->is_null($mmhclass->input->post_vars['password-c']) == true || $mmhclass->funcs->is_null($mmhclass->input->post_vars['email_address']) == true || $mmhclass->funcs->is_null($mmhclass->input->post_vars['sql_host']) == true || $mmhclass->funcs->is_null($mmhclass->input->post_vars['sql_database']) == true || $mmhclass->funcs->is_null($mmhclass->input->post_vars['sql_username']) == true) {
				$mmhclass->templ->error($mmhclass->lang['003'], true);
			} elseif ($mmhclass->funcs->valid_email($mmhclass->input->post_vars['email_address']) == false) {
				$mmhclass->templ->error(sprintf($mmhclass->lang['004'], strtolower($mmhclass->input->post_vars['email_address'])), true);
			} elseif ($mmhclass->input->post_vars['password'] !== $mmhclass->input->post_vars['password-c']) {
				$mmhclass->templ->error($mmhclass->lang['006'], true);
			} elseif (strlen($mmhclass->input->post_vars['password']) < 6 || strlen($mmhclass->input->post_vars['password']) > 30) {
				$mmhclass->templ->error($mmhclass->lang['005'], true);
			} elseif ($mmhclass->funcs->valid_string($mmhclass->input->post_vars['username']) == false || strlen($mmhclass->input->post_vars['username']) < 3 || strlen($mmhclass->input->post_vars['username']) > 30) {
				$mmhclass->templ->error(sprintf($mmhclass->lang['007'], $mmhclass->input->post_vars['username']), true);
			} elseif (is_writable("{$mmhclass->info->root_path}images/") == false || is_readable("{$mmhclass->info->root_path}images/") == false) {
				$mmhclass->templ->error($mmhclass->lang['009'], true);
			} else {
				if ($mmhclass->db->connect($mmhclass->input->post_vars['sql_host'], $mmhclass->input->post_vars['sql_username'], $mmhclass->input->post_vars['sql_password'], $mmhclass->input->post_vars['sql_database'], 3306, true) == false) {
					$mmhclass->templ->error($mmhclass->lang['903'], true);
				}

				$mmhclass->db->install_queries = array();
				
				$server_token = base64_encode(serialize(array("url" => $mmhclass->info->base_url, "time" => time(), "admin" => $mmhclass->input->server_vars['server_admin'], "version" => $mmhclass->info->version, "site" => $mmhclass->input->server_vars['http_host'])));
				$server_license = $mmhclass->funcs->get_http_content("http://callhome.mihalism.net/multihost/?id={$server_token}", 1);
				
				//$mmhclass->db->install_queries[] = array("CREATE DATABASE IF NOT EXISTS `[1]`;", array($mmhclass->input->post_vars['sql_database']));

				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_ADMIN_CACHE_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_BAN_FILTER_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_FILE_LOGS_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_FILE_RATINGS_TABLE));	
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_FILE_STORAGE_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_GALLERY_ALBUMS_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_SITE_CACHE_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_ROBOT_LOGS_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_USER_PASSWORDS_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_USER_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("DROP TABLE IF EXISTS `[1]`;", array(MYSQL_USER_SESSIONS_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `cache_id` varchar(70) NOT NULL default '',
				  `cache_value` text NOT NULL,
				  PRIMARY KEY  (`cache_id`)
				) TYPE=MyISAM;", array(MYSQL_ADMIN_CACHE_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `ban_id` int(25) NOT NULL auto_increment,
				  `time_banned` int(10) NOT NULL default '0',
				  `ban_type` tinyint(1) NOT NULL default '0',
				  `ban_value` text NOT NULL,
				  PRIMARY KEY  (`ban_id`)
				) TYPE=MyISAM;", array(MYSQL_BAN_FILTER_TABLE));
				
				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `log_id` int(25) NOT NULL auto_increment,
				  `filename` varchar(30) NOT NULL default '',
				  `filesize` int(20) NOT NULL default '0',
				  `ip_address` varchar(15) NOT NULL default '',
				  `user_agent` varchar(255) NOT NULL,
				  `time_uploaded` int(10) NOT NULL default '0',
				  `gallery_id` int(32) NOT NULL default '0',
				  `is_private` tinyint(1) NOT NULL default '0',
				  `original_filename` varchar(255) NOT NULL default '',
				  `upload_type` varchar(6) NOT NULL default 'normal',
				  PRIMARY KEY  (`log_id`),
				  UNIQUE KEY `filename` (`filename`)
				) TYPE=MyISAM;", array(MYSQL_FILE_LOGS_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `rating_id` int(25) NOT NULL auto_increment,
				  `filename` varchar(30) NOT NULL default '',
				  `total_rating` int(5) NOT NULL default '5',
				  `total_votes` int(30) NOT NULL default '1',
				  `voted_by` longtext NOT NULL,
				  `is_private` tinyint(1) NOT NULL default '0',
				  `gallery_id` int(25) NOT NULL default '0',
				  PRIMARY KEY  (`rating_id`),
				  UNIQUE KEY `filename` (`filename`)
				) TYPE=MyISAM;", array(MYSQL_FILE_RATINGS_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `file_id` int(25) NOT NULL auto_increment,
				  `filename` varchar(30) NOT NULL default '',
				  `is_private` tinyint(1) NOT NULL default '0',
				  `gallery_id` int(25) NOT NULL default '0',
				  `album_id` int(25) NOT NULL default '0',
				  `file_title` varchar(35) NOT NULL default '',
				  `viewer_clicks` int(25) NOT NULL default '1',
				  PRIMARY KEY  (`file_id`),
				  UNIQUE KEY `filename` (`filename`)
				) TYPE=MyISAM;", array(MYSQL_FILE_STORAGE_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `album_id` int(25) NOT NULL auto_increment,
				  `gallery_id` int(25) NOT NULL default '0',
				  `album_title` varchar(50) NOT NULL default '',
				  `password` varchar(32) NOT NULL default '',
				  `is_private` tinyint(1) NOT NULL default '0',
				  PRIMARY KEY  (`album_id`)
				) TYPE=MyISAM;", array(MYSQL_GALLERY_ALBUMS_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `robot_id` int(25) NOT NULL auto_increment,
				  `preg_match` varchar(255) NOT NULL,
				  `robot_name` varchar(100) NOT NULL,
				  PRIMARY KEY  (`robot_id`)
				) TYPE=MyISAM;", array(MYSQL_ROBOT_INFO_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `log_id` int(25) NOT NULL auto_increment,
				  `robot_id` int(25) NOT NULL default '0',
				  `page_indexed` tinytext NOT NULL,
				  `time_indexed` int(10) NOT NULL default '0',
				  `ip_address` varchar(15) NOT NULL default '',
				  `user_agent` varchar(255) NOT NULL,
				  `http_referer` tinytext NOT NULL,
				  PRIMARY KEY  (`log_id`)
				) TYPE=MyISAM;", array(MYSQL_ROBOT_LOGS_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `cache_id` varchar(70) NOT NULL default '',
				  `cache_value` text NOT NULL,
				  PRIMARY KEY  (`cache_id`)
				) TYPE=MyISAM;", array(MYSQL_SITE_CACHE_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `config_key` varchar(70) NOT NULL default '',
				  `config_value` text NOT NULL,
				  PRIMARY KEY  (`config_key`),
				  UNIQUE KEY `config_key` (`config_key`)
				) TYPE=MyISAM;", array(MYSQL_SITE_SETTINGS_TABLE));
				
				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `password_id` int(25) NOT NULL auto_increment,
				  `auth_key` varchar(32) NOT NULL default '',
				  `user_id` int(25) NOT NULL default '0',
				  `new_password` varchar(32) NOT NULL default '',
				  `time_requested` int(10) NOT NULL default '0',
				  `ip_address` varchar(15) NOT NULL default '0',
				  PRIMARY KEY  (`password_id`),
				  UNIQUE KEY `password` (`new_password`),
				  UNIQUE KEY `auth_key` (`auth_key`)
				) TYPE=MyISAM;", array(MYSQL_USER_PASSWORDS_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `user_id` int(25) NOT NULL auto_increment,
				  `username` varchar(30) NOT NULL default '',
				  `password` varchar(32) NOT NULL default '',
				  `email_address` varchar(255) NOT NULL,
				  `ip_address` varchar(15) NOT NULL default '',
				  `private_gallery` tinyint(1) NOT NULL default '0',
				  `time_joined` int(10) NOT NULL default '0',
				  `user_group` varchar(20) NOT NULL default '',
				  `upload_type` varchar(8) NOT NULL default 'standard',
				  PRIMARY KEY  (`user_id`),
				  UNIQUE KEY `username` (`username`)
				) TYPE=MyISAM;", array(MYSQL_USER_INFO_TABLE));

				$mmhclass->db->install_queries[] = array("CREATE TABLE `[1]` (
				  `session_id` varchar(32) NOT NULL default '',
				  `session_start` int(10) NOT NULL default '0',
				  `user_id` int(25) NOT NULL default '0',
				  `ip_address` varchar(15) NOT NULL default '',
				  `user_agent` varchar(255) NOT NULL,
				  PRIMARY KEY  (`session_id`)
				) TYPE=MyISAM;", array(MYSQL_USER_SESSIONS_TABLE));

				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`cache_id`, `cache_value`) VALUES ('page_views', '1');", array(MYSQL_SITE_CACHE_TABLE));

				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (1, 'AdsBot-Google', 'AdsBot [Google]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (2, 'ia_archiver', 'Alexa [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (3, 'Scooter/', 'Alta Vista [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (4, 'Ask Jeeves', 'Ask Jeeves [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (5, 'Baidurobot', 'Baidu [robot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (6, 'Exabot/', 'Exabot [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (7, 'FAST Enterprise Crawler', 'FAST Enterprise [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (8, 'FAST-WebCrawler/', 'FAST WebCrawler [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (9, 'http://www.neomo.de/', 'Francis [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (10, 'Gigabot/', 'Gigabot [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (11, 'Mediapartners-Google/', 'Google Adsense [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (12, 'Google Desktop', 'Google Desktop');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (13, 'Feedfetcher-Google', 'Google Feedfetcher');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (14, 'Googlebot', 'Google [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (15, 'heise-IT-Markt-Crawler', 'Heise IT-Markt [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (16, 'heritrix/1.', 'Heritrix [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (17, 'ibm.com/cs/crawler', 'IBM Research [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (18, 'ICCrawler - ICjobs', 'ICCrawler - ICjobs');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (19, 'ichiro/2', 'ichiro [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (20, 'MJ12bot/', 'Majestic-12 [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (21, 'MetagerBot/', 'Metager [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (22, 'MihalismBot', 'Mihalism [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (23, 'msnbot-NewsBlogs/', 'MSN NewsBlogs');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (24, 'msnbot/', 'MSN [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (25, 'msnbot-media/', 'MSNbot Media');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (26, 'NG-Search/', 'NG-Search [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (27, 'http://lucene.apache.org/nutch/', 'Nutch [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (28, 'NutchCVS/', 'Nutch/CVS [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (29, 'OmniExplorer_Bot/', 'OmniExplorer [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (30, 'online link validator', 'Online link [Validator]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (31, 'psbot/0', 'psbot [Picsearch]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (32, 'Seekbot/', 'Seekport [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (33, 'Sensis Web Crawler', 'Sensis [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (34, 'SEO search Crawler/', 'SEO Crawler');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (35, 'Seoma [SEO Crawler]', 'Seoma [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (36, 'SEOsearch/', 'SEOSearch [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (37, 'Snappy/1.1 ( http://www.urltrends.com/ )', 'Snappy [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (38, 'http://www.tkl.iis.u-tokyo.ac.jp/~crawler/', 'Steeler [Crawler]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (39, 'SynooBot/', 'Synoo [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (40, 'crawleradmin.t-info@telekom.de', 'Telekom [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (41, 'TurnitinBot/', 'TurnitinBot [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (42, 'voyager/1.0', 'Voyager [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (43, 'W3 SiteSearch Crawler', 'W3 [Sitesearch]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (44, 'W3C-checklink/', 'W3C [Linkcheck]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (45, 'W3C_Validator', 'W3C [Validator]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (46, 'http://www.WISEnutbot.com', 'WiseNut [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (47, 'yacybot', 'Yacy [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (48, 'Yahoo-MMCrawler/', 'Yahoo MMCrawler [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (49, 'Yahoo! DE Slurp', 'Yahoo Slurp [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (50, 'Yahoo! Slurp', 'Yahoo [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (51, 'YahooSeeker/', 'YahooSeeker [Bot]');", array(MYSQL_ROBOT_INFO_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`robot_id`, `preg_match`, `robot_name`) VALUES (52, 'W3C_CSS_Validator', 'W3C [Validator]');", array(MYSQL_ROBOT_INFO_TABLE));

				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('thumbnail_width', '160');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('thumbnail_height', '160');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('thumbnail_type', 'png');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('advanced_thumbnails', '0');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('date_format', 'F j, Y, g:i:s A');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('max_results', '20');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('upload_path', 'images/');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('file_extensions', 'jpeg,jpg,gif,png');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('user_file_extensions', 'jpeg,jpg,gif,png,ico');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('max_filesize', '1075000');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('user_max_filesize', '3145728');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('site_name', 'MultiHoster');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('gallery_viewing', '1');", array(MYSQL_SITE_SETTINGS_TABLE));				
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('uploading_disabled', '0');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('registration_disabled', '0');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('useronly_uploading', '0');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('recaptcha_public', '6Le1xAUAAAAAAJfAE0pXUDSvN-sHVp6y337IzLZ5');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('recaptcha_private', '6Le1xAUAAAAAAHIv7fSE0Tqn-05yf7lfWupzFrwS');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('google_analytics', 'UA-1125794-2');", array(MYSQL_SITE_SETTINGS_TABLE));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('server_license', '[2]');", array(MYSQL_SITE_SETTINGS_TABLE, $server_license));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('email_in', '[2]');", array(MYSQL_SITE_SETTINGS_TABLE, $mmhclass->input->post_vars['email_address']));
				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`config_key`, `config_value`) VALUES ('email_out', '[2]');", array(MYSQL_SITE_SETTINGS_TABLE, "noreply@{$mmhclass->input->server_vars['http_host']}"));

				$mmhclass->db->install_queries[] = array("INSERT INTO `[1]` (`username`, `password`, `email_address`, `ip_address`, `private_gallery`, `time_joined`, `user_group`, `upload_type`) VALUES ('[2]', '[3]', '[4]', '[5]', 0, '[6]', 'root_admin', 'standard');", array(MYSQL_USER_INFO_TABLE, $mmhclass->input->post_vars['username'], md5($mmhclass->input->post_vars['password']), $mmhclass->input->post_vars['email_address'], $mmhclass->input->server_vars['remote_addr'], time()));
																																												
				foreach ($mmhclass->db->install_queries as $the_query) {
					$mmhclass->db->query($the_query['0'], $the_query['1']);
				}
				
				if ($htaccess = fopen("{$mmhclass->info->root_path}images/.htaccess", "ab")) {
					fwrite($htaccess, "\nErrorDocument 404 {$mmhclass->info->script_path}css/images/error404.gif");
					chmod("{$mmhclass->info->root_path}images/.htaccess", 0444);
				}

				if ($config = fopen("{$mmhclass->info->root_path}source/includes/config.php", "wb")) {
					$file_string = "<?"."php\n\n";
					$file_string .= "\t\$"."mmhclass->info->config                = array();\n";
					$file_string .= "\t\$mmhclass->info->site_installed           = true; // Set to false to reinstall\n\n";
					$file_string .= "\t/"."* DATABASE INFORMATION *"."/ \n";
					$file_string .= "\t\$mmhclass->info->config['sql_host']       = \"{$mmhclass->input->post_vars['sql_host']}\";\n";
					$file_string .= "\t\$mmhclass->info->config['sql_username']   = \"{$mmhclass->input->post_vars['sql_username']}\";\n";
					$file_string .= "\t\$mmhclass->info->config['sql_password']   = \"{$mmhclass->input->post_vars['sql_password']}\";\n";
					$file_string .= "\t\$mmhclass->info->config['sql_database']   = \"{$mmhclass->input->post_vars['sql_database']}\";\n\n";
					$file_string .= "\n\n?".">";
					
					if (fwrite($config, $file_string) == false) {
						$mmhclass->templ->error($mmhclass->lang['010'], true);
					}
					
					chmod("{$mmhclass->info->root_path}source/includes/config.php", 0444);
					
					fclose($config);
				} else {
					$config->templ->error($mmhclass->lang['010'], true);
				}

				$mmhclass->templ->message($mmhclass->lang['011'], true);
			}
			break;
		default:
			$mmhclass->templ->output("install", "installer_intro_page");
	}
	
?>