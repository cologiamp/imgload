<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251325133 - Wednesday, August 26, 2009, 06:18:53 PM EDT -0400
	// ======================================== /
	
	if (is_object($mmhclass) == false) { exit; }
	
	$mmhclass->templ->templ_globals['upload_type'] = (($mmhclass->funcs->is_null($mmhclass->input->get_vars['url']) == false) ? "url" : "std");
	
	$mmhclass->templ->templ_vars[] = array("BASE_URL" => $mmhclass->info->base_url);
	
	exit($mmhclass->templ->parse_template("tools", "iframe_uploader"));

?>