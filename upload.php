<?php 
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251588116 - Saturday, August 29, 2009, 07:21:56 PM EDT -0400
	// ======================================== /
	
	require_once "./source/includes/data.php";
	require_once "{$mmhclass->info->root_path}source/language/upload.php";
	session_start();
	$_SESSION['time'] = time();
	$mmhclass->templ->page_title = sprintf($mmhclass->lang['001'], $mmhclass->info->config['site_name']);
	$size = $_POST['thumbsize'];
	if($size==""){
	$size=180;
	}
	
	if ($mmhclass->info->config['uploading_disabled'] == true && $mmhclass->info->is_admin == false) {
		$mmhclass->templ->page_title = $mmhclass->lang['005'];
		$mmhclass->templ->error($mmhclass->lang['004'], true);
	} elseif ($mmhclass->info->config['useronly_uploading'] == true && $mmhclass->info->is_user == false) {
		$mmhclass->templ->page_title = $mmhclass->lang['005'];
		$mmhclass->templ->error($mmhclass->lang['007'], true);
	}
	
	switch ($mmhclass->input->post_vars['upload_type']) {
		case "url-boxed":
		case "url-standard":
			
			if (ini_get("allow_url_fopen") == false && USE_CURL_LIBRARY == false) {
				$mmhclass->templ->error($mmhclass->lang['011'], true);
			} else {
				$files = $mmhclass->input->post_vars['userfile'];
				$mmhclass->input->post_vars['userfile'] = array();
				
				switch ($mmhclass->input->post_vars['url_upload_type']) {
					case "paste_upload":
						$mmhclass->input->post_vars['userfile'] = array_map("trim", explode("\n", $mmhclass->input->post_vars['paste_upload'], $mmhclass->info->config['max_results']));
						break;
					case "webpage_upload":
						if ($mmhclass->funcs->is_null($mmhclass->input->post_vars['webpage_upload']) == false) {
							$urlparts = parse_url($mmhclass->input->post_vars['webpage_upload']);
							
							$webpage_headers = $mmhclass->funcs->get_headers($mmhclass->input->post_vars['webpage_upload']);
							$webpage_content = $mmhclass->funcs->get_http_content($webpage_headers['Address'], 2);
							
							if ($mmhclass->funcs->is_null($webpage_content) == true) {
								$mmhclass->templ->error($mmhclass->lang['743'], true);
							} else {
								preg_match_all(sprintf("#<img([^\>]+)src=('|\"|)([^\s]+)\.((%s)[^\?]+)('|\"|)#Ui", implode("|", $mmhclass->info->config['file_extensions'])), $webpage_content, $image_matches);
								
								$image_matches['3'] = array_unique($image_matches['3']);
								
								foreach ($image_matches['3'] as $id => $url) {
									if ($id < $mmhclass->info->config['max_results']) {
										if (preg_match("#^(http|https):\/\/([^\s]+)$#i", $url) >= 1) {
											$mmhclass->input->post_vars['userfile'][] = sprintf("%s.%s", $url, $image_matches['5'][$id]);
										} elseif (preg_match("#^\/([^\s]+)$#", $url) >= 1) {
											$mmhclass->input->post_vars['userfile'][] = sprintf("%s://%s%s.%s", $urlparts['scheme'], $urlparts['host'], $url, $image_matches['5'][$id]);
										} else {
											$mmhclass->input->post_vars['userfile'][] = sprintf("%s://%s%s%s.%s", $urlparts['scheme'], $urlparts['host'], sprintf("%s/", dirname($urlparts['path'])), $url, $image_matches['5'][$id]);
										}
									}
								}
							}
							
							if ($mmhclass->funcs->is_null($mmhclass->input->post_vars['userfile']) == true) {
								$mmhclass->templ->error($mmhclass->lang['254'], true);
							} else {
								foreach ($mmhclass->input->post_vars['userfile'] as $imageurl) {
									$mmhclass->templ->templ_globals['get_whileloop'] = true;
									
									$break_line = (($tdcount >= 4) ? true : false);
									$tdcount = (($tdcount >= 4) ? 0 : $tdcount);
									$tdcount++;
									
									$mmhclass->templ->templ_vars[] = array(
										"IMAGE_URL" => $imageurl,
										"FILENAME" => $mmhclass->image->basename($imageurl),
										"MAX_WIDTH" => $mmhclass->info->config['thumbnail_width'],
										"TABLE_BREAK" => (($break_line == true) ? "</tr><tr>" : NULL),
										"TDCLASS" => $tdclass = (($tdclass == "tdrow1") ? "tdrow2" : "tdrow1"),
									);
									
									$mmhclass->templ->templ_globals['urlupload_gallery_layout'] .= $mmhclass->templ->parse_template("upload", "webpage_upload_image_select");
									unset($mmhclass->templ->templ_vars, $break_line, $mmhclass->templ->templ_globals['get_whileloop']);	
								}
							
								$mmhclass->templ->templ_vars[] = array(
									"WEBPAGE_URL" => $webpage_headers['Address'],
									"UPLOAD_TO" => $mmhclass->input->post_vars['upload_to'],
									"UPLOAD_TYPE" => $mmhclass->input->post_vars['upload_type'],
									"PRIVATE_UPLOAD" => $mmhclass->input->post_vars['private_upload'],
									"WEBPAGE_URL_SMALL" => $mmhclass->funcs->shorten_url($webpage_headers['Address'], 60),
								);
							
								$mmhclass->templ->output("upload", "webpage_upload_image_select");	
							}
						}
						break;
					default:
						$mmhclass->input->post_vars['userfile'] = $files;
				}
				
				foreach ($mmhclass->input->post_vars['userfile'] as $i => $name) {
					if ($mmhclass->funcs->is_null($mmhclass->input->post_vars['userfile'][$i]) == false && $mmhclass->input->post_vars['userfile'][$i] !== "http://") {
						if ($total_file_uploads < count($mmhclass->input->post_vars['userfile'])) {
							$origname = $mmhclass->image->basename($mmhclass->input->post_vars['userfile'][$i]);
							
							$filetitle = strip_tags((strlen($origname) > 20) ? sprintf("%s...", substr($origname, 0, 20)) : $origname);
							$filename = sprintf("%s.%s", $mmhclass->funcs->random_string(20, "0123456789"), ($extension = $mmhclass->image->file_extension($origname)));
							
							$file_headers = $mmhclass->funcs->get_headers($mmhclass->input->post_vars['userfile'][$i]);
							$file_content = ((in_array("HTTP/1.0 200 OK", $file_headers) == true || in_array("HTTP/1.1 200 OK", $file_headers) == true) ? $mmhclass->funcs->get_http_content($file_headers['Address'], 2) : NULL);
							
							if ($mmhclass->funcs->is_url($file_headers['Address']) == false) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['012'], $origname), "error");
							} elseif ($mmhclass->funcs->is_null($file_content) == true) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['013'], $origname), "error");
							} elseif (in_array($mmhclass->image->file_extension($origname), $mmhclass->info->config['file_extensions']) == false) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['002'], $origname, $extension), "message");
							} elseif (($filesize = strlen($file_content)) > $mmhclass->info->config['max_filesize']) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['003'], $origname, $mmhclass->image->format_filesize($mmhclass->info->config['max_filesize'])), "message");
							} elseif ($mmhclass->funcs->is_file($filename, $mmhclass->info->root_path.$mmhclass->info->config['upload_path']) == true) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['009'], $origname), "error");
							} elseif (fwrite(fopen($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$filename, "wb"), $file_content) == false) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['010'], $origname), "error");
							} else {
								chmod($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$filename, 0644);
								
								$filename_array = explode(".",$filename);
								
								$filename_thumb = $filename_array[0]."_thumb".".".$filename_array[1];
								
								$microtime = $_SESSION['time'];
								//$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `is_private`, `gallery_id`, `file_title`, `album_id`) VALUES ('[2]', '[3]', '[4]', '[5]', '[6]'); ", array(MYSQL_FILE_STORAGE_TABLE, $filename, $mmhclass->input->post_vars['private_upload'], $mmhclass->info->user_data['user_id'], $filetitle, $mmhclass->input->post_vars['upload_to']));																																							
								$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `filename_thumb`, `is_private`, `gallery_id`, `file_title`, `album_id`, `microtime`, `ip`) VALUES ('[2]', '[3]', '[4]', '[5]', '[6]', '[7]', '[8]', '[9]'); ", array(MYSQL_FILE_STORAGE_TABLE, $filename, $filename_thumb, $mmhclass->input->post_vars['private_upload'], $mmhclass->info->user_data['user_id'], $filetitle, $mmhclass->input->post_vars['upload_to'], $microtime, $mmhclass->input->server_vars['remote_addr']));																																							

								$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `filesize`, `ip_address`, `user_agent`, `time_uploaded`, `gallery_id`, `is_private`, `original_filename`, `upload_type`) VALUES ('[2]', '[3]', '[4]', '[5]', '[6]', '[7]', '[8]', '[9]', 'url'); ", array(MYSQL_FILE_LOGS_TABLE, $filename, $filesize, $mmhclass->input->server_vars['remote_addr'], $mmhclass->input->server_vars['http_user_agent'], time(), $mmhclass->info->user_data['user_id'], $mmhclass->input->post_vars['private_upload'], strip_tags($origname)));
								$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `total_rating`, `total_votes`, `voted_by`, `gallery_id`, `is_private`) VALUES ('[2]', '0', '0', '', '[3]', '[4]');", array(MYSQL_FILE_RATINGS_TABLE, $filename, $mmhclass->info->user_data['user_id'], $mmhclass->input->post_vars['private_upload']));
								
								//$mmhclass->image->create_thumbnail($filename);
								$mmhclass->image->create_thumbnail($filename, $size);
								
								$uploadinfo[]['result'] = $filename;							
							
								unset($origname, $filetitle, $filename, $filename_thumb, $file_headers, $file_content, $filesize, $extension);
							}
							
							$total_file_uploads++;
						}
					}
				}
			}
			break;
		case "standard":
		case "normal-boxed":
			
			foreach ($mmhclass->input->file_vars['userfile']['name'] as $i => $name) {
				if (array_key_exists($i, $mmhclass->input->file_vars['userfile']['error']) == false && array_key_exists($i, $mmhclass->input->file_vars['userfile']['name']) == true || array_key_exists($i, $mmhclass->input->file_vars['userfile']['error']) == true && array_key_exists($i, $mmhclass->input->file_vars['userfile']['name']) == true) {
					if (array_key_exists($i, $mmhclass->input->file_vars['userfile']['error']) == false && $mmhclass->funcs->is_null($mmhclass->input->file_vars['userfile']['name'][$i]) == false || $mmhclass->input->file_vars['userfile']['error'][$i] !== 4 && $mmhclass->funcs->is_null($mmhclass->input->file_vars['userfile']['name'][$i]) == false) {
						if ($total_file_uploads < count($mmhclass->input->file_vars['userfile']['name'])) {
							$origname = $mmhclass->image->basename($mmhclass->input->file_vars['userfile']['name'][$i]);
							
							$filetitle = strip_tags((strlen($origname) > 20) ? sprintf("%s...", substr($origname, 0, 20)) : $origname);
							$filename = sprintf("%s.%s", $mmhclass->funcs->random_string(20, "0123456789"), ($extension = $mmhclass->image->file_extension($origname)));
							
							if (in_array($extension, $mmhclass->info->config['file_extensions']) == false) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['002'], $origname, $extension), "message");
							} elseif ($mmhclass->input->file_vars['userfile']['size'][$i] > $mmhclass->info->config['max_filesize']) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['003'], $origname, $mmhclass->image->format_filesize($mmhclass->info->config['max_filesize'])), "message");
							} elseif ($mmhclass->image->is_image($mmhclass->input->file_vars['userfile']['tmp_name'][$i]) == false) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['006'], $origname), "message");
							} elseif ($mmhclass->input->file_vars['userfile']['error'][$i] > 0) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['008'][$mmhclass->input->file_vars['userfile']['error'][$i]], $origname), "error");
							} elseif ($mmhclass->funcs->is_file($filename, $mmhclass->info->root_path.$mmhclass->info->config['upload_path']) == true) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['009'], $filename), "error");
							} elseif (move_uploaded_file($mmhclass->input->file_vars['userfile']['tmp_name'][$i], $mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$filename) == false) {
								$uploadinfo[]['error'] = array(sprintf($mmhclass->lang['010'], $origname), "error");
							} else {
								chmod($mmhclass->info->root_path.$mmhclass->info->config['upload_path'].$filename, 0644);
								
								
								//$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `is_private`, `gallery_id`, `file_title`, `album_id`) VALUES ('[2]', '[3]', '[4]', '[5]', '[6]'); ", array(MYSQL_FILE_STORAGE_TABLE, $filename, $mmhclass->input->post_vars['private_upload'], $mmhclass->info->user_data['user_id'], $filetitle, $mmhclass->input->post_vars['upload_to']));																																							
								
								$filename_array = explode(".",$filename);
								
								$filename_thumb = $filename_array[0]."_thumb".".".$filename_array[1];
								
								$microtime = $_SESSION['time'];
								
								
								/*
								//FTP SERVERS FOR CDN CONFIGURATION AND COPYING -- MULTI HOSTER
							
								$ftp_server = "82.192.68.214";
								$ftp_user_name = "ftpuser";
								$ftp_user_pass = "156252158Cologiamp";
								
								$file = $filename;
								$remote_file = $filename;
								
								
								$file2 = $filename_thumb;
								$remote_file2 = $filename_thumb;
								
								// establecer una conexión básica
								$conn_id = ftp_connect($ftp_server);

								// iniciar sesión con nombre de usuario y contraseña
								$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

								// cargar un archivo
								ftp_put($conn_id, "images/".$remote_file, "images/".$file, FTP_ASCII);
								
								//cargar la thumb
								ftp_put($conn_id, "images/".$remote_file2, "images/".$file2, FTP_ASCII);
								
								// cerrar la conexión ftp
								ftp_close($conn_id);

								//END FTP CONFIGURATION
								*/
								

								$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `filename_thumb`, `is_private`, `gallery_id`, `file_title`, `album_id`, `microtime`, `ip`) VALUES ('[2]', '[3]', '[4]', '[5]', '[6]', '[7]', '[8]', '[9]'); ", array(MYSQL_FILE_STORAGE_TABLE, $filename, $filename_thumb, $mmhclass->input->post_vars['private_upload'], $mmhclass->info->user_data['user_id'], $filetitle, $mmhclass->input->post_vars['upload_to'], $microtime, $mmhclass->input->server_vars['remote_addr']));																																							
								
								$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `filesize`, `ip_address`, `user_agent`, `time_uploaded`, `gallery_id`, `is_private`, `original_filename`, `upload_type`) VALUES ('[2]', '[3]', '[4]', '[5]', '[6]', '[7]', '[8]', '[9]', 'normal'); ", array(MYSQL_FILE_LOGS_TABLE, $filename, $mmhclass->input->file_vars['userfile']['size'][$i], $mmhclass->input->server_vars['remote_addr'], $mmhclass->input->server_vars['http_user_agent'], time(), $mmhclass->info->user_data['user_id'], $mmhclass->input->post_vars['private_upload'], strip_tags($origname)));
								$mmhclass->db->query("INSERT INTO `[1]` (`filename`, `total_rating`, `total_votes`, `voted_by`, `gallery_id`, `is_private`) VALUES ('[2]', '0', '0', '', '[3]', '[4]');", array(MYSQL_FILE_RATINGS_TABLE, $filename, $mmhclass->info->user_data['user_id'], $mmhclass->input->post_vars['private_upload']));
								
								$mmhclass->image->create_thumbnail($filename, $size);
								
								$uploadinfo[]['result'] = $filename; 	
								
								unset($origname, $filetitle, $filename, $extension);
							}
							
							$total_file_uploads++;
						}
					}
				}
			}
			break;
	}
	
	if (in_array($mmhclass->input->post_vars['upload_type'], array("standard", "url-standard")) == true) {
		if ($mmhclass->funcs->is_null($uploadinfo) == false) {
			$mmhclass->templ->html = NULL;
			
			foreach ($uploadinfo as $id => $value) {
				$mmhclass->templ->html .= (($total_file_uploads > 1 && $id !== 0) ? "<hr />" : NULL);
				$mmhclass->templ->html .= ((is_array($uploadinfo[$id]['error']) == true) ? $mmhclass->templ->$uploadinfo[$id]['error']['1']($uploadinfo[$id]['error']['0'], false) : $mmhclass->templ->file_results($uploadinfo[$id]['result']));
			}
		}
	} else {
		if ($mmhclass->funcs->is_null($uploadinfo) == false) {
			foreach ($uploadinfo as $id => $value) {
				if (is_array($uploadinfo[$id]['error']) == false) {
					$mmhclass->templ->templ_globals['uploadinfo'][] = $uploadinfo[$id]['result'];
				} else {
					$mmhclass->templ->templ_globals['errorinfo'][] = $uploadinfo[$id]['error']['0'];
				}
			}
		
			if ($mmhclass->funcs->is_null($mmhclass->templ->templ_globals['uploadinfo']) == false) {
				for ($i = 1; $i < 6; $i++) {
					foreach ($mmhclass->templ->templ_globals['uploadinfo'] as $filename) {
						$mmhclass->templ->templ_globals['get_whileloop']["uploadinfo_whileloop_{$i}"] = true;
						
						$mmhclass->templ->templ_vars[] = array(
							"FILENAME" => $filename,
							"BASE_URL" => $mmhclass->info->base_url,
							"SITE_NAME" => $mmhclass->info->config['site_name'],
							"UPLOAD_PATH" => $mmhclass->info->config['upload_path'],
							"THUMBNAIL" => (($mmhclass->funcs->is_file(($thumbnail = $mmhclass->image->thumbnail_name($filename)), $mmhclass->info->root_path.$mmhclass->info->config['upload_path']) == false) ? "{$mmhclass->info->base_url}css/images/no_thumbnail.png" : $mmhclass->info->base_url.$mmhclass->info->config['upload_path'].$thumbnail),
						);
						
						$mmhclass->templ->templ_globals["uploadinfo_whileloop_{$i}"] .= $mmhclass->templ->parse_template("upload", "boxed_file_results");
						unset($mmhclass->templ->templ_globals['get_whileloop'], $mmhclass->templ->templ_vars, $thumbnail);		
					}
				}
				
				foreach ($mmhclass->templ->templ_globals['uploadinfo'] as $filename) {
					$break_line = (($tdcount >= 4) ? true : false);
					$tdcount = (($tdcount >= 4) ? 0 : $tdcount);
					$tdcount++;
										
								
					$filename_array = explode(".",$filename);
					$filename_thumb = $filename_array[0]."_thumb.".$filename_array[1];
					
					
					$mmhclass->templ->templ_vars[] = array(
						"FILENAME" => $filename,
						"FILENAME_THUMB" => $filename_thumb,
						"FILE_TITLE" => $filename,
						"TABLE_BREAK" => (($break_line == true) ? "</tr><tr>" : NULL),
						"TDCLASS" => $tdclass = (($tdclass == "tdrow1") ? "tdrow2" : "tdrow1"),
					);
					
					$gallery_html .= $mmhclass->templ->parse_template("global", "global_gallery_layout");
					unset($mmhclass->templ->templ_vars, $break_line);	
				}
			}
			
			if ($mmhclass->funcs->is_null($mmhclass->templ->templ_globals['errorinfo']) == false) {
				foreach ($mmhclass->templ->templ_globals['errorinfo'] as $errmsg) {
					$mmhclass->templ->templ_globals['get_whileloop']['errorinfo_whileloop'] = true;
					$mmhclass->templ->templ_vars[] = array("ERROR_MESSAGE" => $errmsg['0']);
					$mmhclass->templ->templ_globals['errorinfo_whileloop'] .= $mmhclass->templ->parse_template("upload", "boxed_file_results");
					unset($mmhclass->templ->templ_globals['get_whileloop'], $mmhclass->templ->templ_vars);	
				}
			}
			
			$mmhclass->templ->templ_vars[] = array(
				"GALLERY_HTML" => $gallery_html,
				"BASE_URL" => $mmhclass->info->base_url,
				"SITE_NAME" => $mmhclass->info->config['site_name'],
			);
			
			$mmhclass->templ->output("upload", "boxed_file_results");
		}
	}
	
	if ($total_file_uploads < 1 && $mmhclass->funcs->is_null($mmhclass->templ->templ_globals['errorinfo']) == true) {
		$mmhclass->templ->error($mmhclass->lang['014'], true);
	} else {	
		if (in_array($mmhclass->input->post_vars['upload_type'], array("standard", "url-standard")) == true) {
			$mmhclass->templ->output();
		}
	}
	
?>