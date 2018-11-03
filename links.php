<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1248238221 - Wednesday, July 22, 2009, 12:50:21 AM EDT -0400
	// ======================================== /

	require_once "./source/includes/data.php";
	require_once "{$mmhclass->info->root_path}source/language/links.php";

	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);

	if ($mmhclass->funcs->is_null($mmhclass->input->get_vars['file']) == true) {
		$mmhclass->templ->error($mmhclass->lang['002'], true);
	} elseif ($mmhclass->funcs->is_file($mmhclass->input->get_vars['file'], $mmhclass->info->root_path.$mmhclass->info->config['upload_path'], true) == false) {
		$mmhclass->templ->error(sprintf($mmhclass->lang['003'], $mmhclass->image->basename($mmhclass->input->get_vars['file'])), true);
	} else {
		$mmhclass->templ->html = $mmhclass->templ->file_results($mmhclass->image->basename($mmhclass->input->get_vars['file']));
		$mmhclass->templ->output();
	}
		
?>