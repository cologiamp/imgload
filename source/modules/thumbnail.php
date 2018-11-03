<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251215184 - Tuesday, August 25, 2009, 11:46:24 AM EDT -0400
	// ======================================== /
	
	if (is_object($mmhclass) == false) { exit; }
	
	$filename = $mmhclass->image->basename($mmhclass->input->get_vars['file']);
	$extension = $mmhclass->image->file_extension($filename);
	$thumbnail = $mmhclass->image->thumbnail_name($filename);

	header("Content-Disposition: inline; filename={$thumbnail};");
	header(sprintf("Content-Type: image/%s;", $mmhclass->info->config['thumbnail_type']));

	if ($mmhclass->funcs->is_file($filename, $mmhclass->info->root_path.$mmhclass->info->config['upload_path']) == false) {
		readfile("{$mmhclass->info->root_path}css/images/error404.gif");
	} elseif ($mmhclass->funcs->is_file($thumbnail, $mmhclass->info->root_path.$mmhclass->info->config['upload_path']) == false) {
		readfile("{$mmhclass->info->root_path}css/images/no_thumbnail.png");
	} else {
		readfile($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$thumbnail);
	}
	
	exit;

?>