<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251325553 - Wednesday, August 26, 2009, 06:25:53 PM EDT -0400
	// ======================================== /
	
	if (is_object($mmhclass) == false) { exit; }
	
	require_once "{$mmhclass->info->root_path}source/language/modules/fileinfo.php";
	
	header("Content-Type: text/plain;");
	header(sprintf("Content-Disposition: inline; filename=fileinfo_html_%s.txt;", mt_rand(1000, 9999)));
	
	if ($mmhclass->funcs->is_null($mmhclass->input->get_vars['file']) == true || $mmhclass->funcs->is_null($mmhclass->input->get_vars['lb_div']) == true) {
		exit($mmhclass->templ->lightbox_error($mmhclass->lang['001']));
	} elseif ($mmhclass->funcs->is_file($mmhclass->input->get_vars['file'], $mmhclass->info->root_path.$mmhclass->info->config['upload_path'], true) == false) {
		exit($mmhclass->templ->lightbox_error(sprintf($mmhclass->lang['002'], $mmhclass->image->basename($mmhclass->input->get_vars['file']))));
	} else {
		$filename = $mmhclass->image->basename($mmhclass->input->get_vars['file']);
		
		$file_info = $mmhclass->image->get_image_info($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$filename);
		$file_logs = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `[1]` WHERE `filename` = '[2]' LIMIT 1;", array(MYSQL_FILE_LOGS_TABLE, $filename)));
		$thumbnail_info = $mmhclass->image->get_image_info($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$mmhclass->image->thumbnail_name($filename));
		$rating_info = $mmhclass->db->fetch_array($mmhclass->db->query("SELECT * FROM `[1]` WHERE `filename` = '[2]' LIMIT 1;", array(MYSQL_FILE_RATINGS_TABLE, $filename)));
		
		$mmhclass->templ->templ_vars[] = array(
			"FILENAME" => $filename,
			"MIME_TYPE" => $file_info['mime'],
			"IMAGE_WIDTH" => $file_info['width'],
			"IMAGE_HEIGHT" => $file_info['height'],
			"THUMBNAIL_HEIGHT" => $thumbnail_info['height'],
			"LIGHTBOX_ID" => $mmhclass->input->get_vars['lb_div'],
			"UPLOAD_PATH" => $mmhclass->info->config['upload_path'],
			"FILE_EXTENSION" => $mmhclass->image->file_extension($filename),
			"TOTAL_FILESIZE" => $mmhclass->image->format_filesize($file_info['bits']),
			"TOTAL_RATINGS" => $mmhclass->funcs->format_number($rating_info['total_votes']),
			"DATE_UPLOADED" => date($mmhclass->info->config['date_format'], $file_info['mtime']),
			"REAL_FILENAME" => (($mmhclass->funcs->is_null($file_logs['original_filename']) == false) ? $file_logs['original_filename'] : $filename),
		);
		
		exit($mmhclass->templ->parse_template("fileinfo"));
	}
	
?>