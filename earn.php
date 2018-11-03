<?php 
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1250799957 - Thursday, August 20, 2009, 04:25:57 PM EDT -0400
	// ======================================== /
	
	require_once "./source/includes/data.php";
	require_once "{$mmhclass->info->root_path}source/language/earn.php";
	require("siteinfo.php");
	
	
	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);
	
	$siteinfo_earningsforaa = $siteinfo_earningsfora*1000;
	$siteinfo_earningsforbb = $siteinfo_earningsforb*1000;
	$siteinfo_earningsforcc = $siteinfo_earningsforc*1000;
	$siteinfo_earningsfordd = $siteinfo_earningsford*1000;
	
	
	$mmhclass->templ->templ_vars[] = array(
		"BASE_URL" => $mmhclass->info->base_url,
		"SITEINFO_BASENAME" => $siteinfo_basename,
		"SITEINFO_RATEA" => $siteinfo_earningsforaa,
		"SITEINFO_RATEB" => $siteinfo_earningsforbb,
		"SITEINFO_RATEC" => $siteinfo_earningsforcc,
		"SITEINFO_RATED" => $siteinfo_earningsfordd,
		"SITE_NAME" => $mmhclass->info->config['site_name'],
	);
	
	$mmhclass->templ->output("earn", "earn_page");
	
?>