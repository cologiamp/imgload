<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251326383 - Wednesday, August 26, 2009, 06:39:43 PM EDT -0400
	// ======================================== /

	require_once "./source/includes/data.php";
	require_once "{$mmhclass->info->root_path}source/language/download.php";

	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);

	if ($mmhclass->funcs->is_null($mmhclass->input->get_vars['file']) == true) {
		$mmhclass->templ->error($mmhclass->lang['002'], true);
	} elseif ($mmhclass->funcs->is_file($mmhclass->input->get_vars['file'], $mmhclass->info->root_path.$mmhclass->info->config['upload_path'], true) == false) {
		$mmhclass->templ->error(sprintf($mmhclass->lang['003'], $mmhclass->image->basename($mmhclass->input->get_vars['file'])), true);
	} else {
		$filename = $mmhclass->image->basename($mmhclass->input->get_vars['file']);
		$file_logs = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `[1]` WHERE `filename` = '[2]' LIMIT 1;", array(MYSQL_FILE_LOGS_TABLE, $filename)));

		header("Content-Description: File Transfer;");
		header("Content-Type: application/force-download;");
		header(sprintf("Content-Length: %s", filesize($mmhclass->root_path.$mmhclass->info->config['upload_path'].$filename)));
		header(sprintf("Content-Disposition: attachment; filename=%s;", $mmhclass->funcs->sanitize_string($file_logs['original_filename'])));
	
		readfile($mmhclass->root_path.$mmhclass->info->config['upload_path'].$filename);
		
		exit;
	}

?>