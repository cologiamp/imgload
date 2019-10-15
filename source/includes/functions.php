<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251468467 - Friday, August 28, 2009, 10:07:47 AM EDT -0400
	// ======================================== /
	
	class mmhclass_core_functions
	{
		// Class Initialization Method
		function __construct() { global $mmhclass; $this->mmhclass = &$mmhclass; }
		
		function is_null($string) 
		{
			return ((empty($string) == false && $string !== 0 && $string !== "0") ? false : true);
		}
		
		function clean_array($array)
		{
			if (is_array($array) == true && $this->is_null($array) == false) {
				$array = array_change_key_case($array);
				
				foreach ($array as $key => $value) {
					if (is_array($value) == true) {
						$array[$key] = $this->clean_array($value);
					} elseif ($this->is_null($value) == false) {
						$array[$key] = trim(stripslashes($value));
					}
				}
			}
			
			return $array;
		}
		
		function is_url($url, $haspath = true)
		{
			$urlparts = parse_url($url);
			
			$pathcheck = (($haspath == true) ? isset($urlparts['path']) : true);
			
			return ((isset($urlparts['scheme']) == true && isset($urlparts['host']) == true && $pathcheck == true) ? true : false);
		}
		
		function get_http_content($url, $timeout = 3)
		{
			if ($this->is_url($url) == true) {
				if (USE_CURL_LIBRARY == true) {
					$curl_handle = curl_init();
					
					curl_setopt($curl_handle, CURLOPT_URL, $url);
					curl_setopt($curl_handle, CURLOPT_MAXREDIRS, 5);
					curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
					
					if (ini_get("open_basedir") == false && ini_get("safe_mode") == false) {
						curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, 1); 
					}
					
					curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, $timeout);
					curl_setopt($curl_handle, CURLOPT_USERAGENT, "ImgPizza @ {$this->mmhclass->info->base_url}");
					
					$returned_c = curl_exec($curl_handle); 
					curl_close($curl_handle); 
					
					return $returned_c;
				} else {
					if (ini_get("allow_url_fopen") !== false) {
						$fileh = fopen($url, "rb");
						
						stream_set_timeout($fileh, $timeout);
						$return_c = stream_get_contents($fileh);
						fclose($fileh); 
						
						return $return_c;
					}
				}
			}
		}
		
		function microtime_float()
		{
			list($usec, $sec) = explode(" ", microtime());
			return ((float)$usec + (float)$sec);
		}
		
		function format_number($number)
		{
			return number_format($number);
		}
		
		function sanitize_string($string) 
		{
			// The characters to retain are from: http://www.php.net/manual/en/filter.filters.sanitize.php
			return preg_replace("/[^a-zA-Z0-9\!#\$%&'\*\+\-\=\?\^_`\{\|\}~@\.\[\]\/\s]/", NULL, $string);	
		}
		
		function shorten_url($url, $length = 45)
		{
			return ((strlen($url) < $length) ? $url : sprintf("%s...", substr($url, 0, $length)));	
		}
		
		function get_headers($url, $redirects = 0) 
		{
			if ($this->is_url($url, false) == true) {
				if ($headers = get_headers($url, 1)) {
					return ((isset($headers['Location']) == true && $redirects < 6) ? $this->get_headers($headers['Location'], ($redirects + 1)) : array_merge($headers, array("Address" => $url)));
				} else {
					if (USE_CURL_LIBRARY == true) {
						$curl_handle = curl_init();
						
						curl_setopt($curl_handle, CURLOPT_URL, $url);
						curl_setopt($curl_handle, CURLOPT_HEADER, 1);
						curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
						
						$response = curl_exec($curl_handle); 
						$info = curl_getinfo($curl_handle);
						$headers = explode("\n", substr($response, 0, $info['header_size']));
						
						foreach ($headers as $id => $header) {
							$header = trim($header);
							
							if (preg_match("#^Location\: ([^\s]+)$#i", $header) == true && $redirects < 6) {
								$theheaders = $this->get_headers(str_replace("Location: ", NULL, $header), ($redirects + 1));	
							} else {
								$header = explode(":", $header);
								
								$key = ((count($header) > 1) ? $header['0'] : $id);
								$body = ((count($header) > 1) ? $header['1'] : $header['0']);
								
								$theheaders[$key] = trim($body);
							}
						}
						
						$theheaders['Address'] = $url; 
						curl_close($curl_handle); 	
						
						return $theheaders;
					} else {
						$this->mmhclass->templ->error($this->mmhclass->lang['1774'], true);
					}
				}
			}
		}
		
		function is_file($filename, $path = NULL, $checkdb = false, $gallery = 0) 
		{
			$filecheck = ((is_file(($this->is_null($path) == false) ? $path.$this->mmhclass->image->basename($filename) : $filename) == true) ? true : false);
			$dbcheck = (($checkdb == true) ? (($this->mmhclass->db->total_rows($this->mmhclass->db->query("SELECT * FROM `[1]` WHERE `filename` = '[2]' [[1]] LIMIT 1;", array(MYSQL_FILE_STORAGE_TABLE, $this->mmhclass->image->basename($filename)), array((($gallery !== 0) ? (" AND `gallery_id` = '{$gallery}' ") : NULL)))) == 1) ? true : false) : false);
			return (($checkdb == false) ? $filecheck : (($filecheck == true && $dbcheck == true) ? true : false));
		}
		
		function is_language_file($lang_id)
		{
			return ((array_key_exists($lang_id, $this->mmhclass->info->language_files) == true && $this->is_file("{$this->mmhclass->info->root_path}source/language/{$this->mmhclass->info->language_files[$lang_id]}") == true) ? true : false);	
		}
		
		function valid_string($string, $valid_chars = DEFAULT_ALLOWED_CHARS_LIST)
		{
			$stringchunks = str_split($string);
			
			foreach ($stringchunks as $char) {
				if (strpos($valid_chars, $char) === false) {
					return false;
				}
			}
			
			return true;
		}
		
		function string2ascii($string) 
		{
			$normstring = str_split($string);
			
			foreach ($normstring as $char) { 
        		$asciival = sprintf("%s%s", $asciival, sprintf("&#%s;", ord($char))); 
    		}
			
			return trim($asciival);
		}
		
		function ascii2string($string) 
		{
			$asciistring = explode(";", $string);
			
			foreach ($asciistring as $char) { 
        		$stringval = sprintf("%s%s", $stringval, chr(str_replace(array("&", ";", "#"), NULL, $char))); 
    		}
			
			return trim($stringval);
		}
		
		function random_string($max_length = 20, $random_chars = DEFAULT_RANDOM_CHARS_LIST)
		{
			$chararray = array_map("strtolower", str_split($random_chars));
			
			for ($i = 1; $i <= $max_length; $i++)  {
				$random_char = array_rand($chararray);
				$random_string = sprintf("%s%s", $random_string, $chararray[$random_char]);
			}
			
			return str_shuffle($random_string);
		}
		
		function valid_email($email_address)
		{
			if (FILTERS_AVAILABLE == true) {
				return ((filter_var(strtolower($email_address), FILTER_VALIDATE_EMAIL) == true) ? true : false);
			} else {
				return ((preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", strtolower($email_address)) == true) ? true : false);
			}
		}
		
		function fetch_url($base = true, $www = true, $query = true)
		{
			$the_url = (($this->is_null($this->mmhclass->input->server_vars['https']) == false) ? "https://" : "http://");
			$the_url .= (($www == true && preg_match("/^www\./", $this->mmhclass->input->server_vars['http_host']) == false) ? "www.{$this->mmhclass->input->server_vars['http_host']}" : $this->mmhclass->input->server_vars['http_host']);
			$the_url .= ((pathinfo($this->mmhclass->input->server_vars['php_self'], PATHINFO_DIRNAME) !== "/") ? sprintf("%s/", pathinfo($this->mmhclass->input->server_vars['php_self'], PATHINFO_DIRNAME)) : pathinfo($this->mmhclass->input->server_vars['php_self'], PATHINFO_DIRNAME)); 
			$the_url .= (($base == true) ? pathinfo($this->mmhclass->input->server_vars['php_self'], PATHINFO_BASENAME) : NULL);
			return (($query == true && $this->is_null($this->mmhclass->input->server_vars['query_string']) == false) ? "{$the_url}?{$this->mmhclass->input->server_vars['query_string']}" : $the_url); 
		}
	}
	
?>