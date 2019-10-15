<?php
	// ======================================== \
	// Package: ImgPizza
	// Version: 5.0.0
	// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
	// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
	// LTE: 1251494889 - Friday, August 28, 2009, 05:28:09 PM EDT -0400
	// ======================================== /
	
	class mmhclass_image_functions
	{
		// Class Initialization Method
		function __construct() { global $mmhclass; $this->mmhclass = &$mmhclass; }
		
		function file_extension($filename)
		{
			$path = explode(".", $filename);
			return strtolower(end($path));
		}
		
		function basename($filename, $extension = NULL)
		{
			if (is_array($filename) == false) {
				return basename(strtolower(trim($filename)), $extension);
			} else {
				return array_map("basename", array_map("strtolower", array_map("trim", $filename)), array($extension));	
			}
		}
		
		function is_image($filename)
		{
			if ($this->mmhclass->funcs->is_file($filename) == true) {
				// exif will be best bet to try first
				
				if (EXIF_IS_AVAILABLE == true) {
					if (exif_imagetype($filename) == false) {
						return false;	
					}
				} else {
					// darn exif is not available! 
					// well hopefully imagick is up
					
					if ($this->manipulator == "imagick") {
						try {
							$imageh = new Imagick();
							$imageh->readImage("{$filename}[0]");
							
							if ($imageh->getImageType() == false) {
								return false;
							}
						} catch (Exception $e) {
							return false;
						}
					} else {
						// Come on seriously? No exif or Imagick?
						// GD supports like nothing. Oh well :(
	
						$imageinfo = getimagesize($filename);
						
						if (isset($imageinfo['2']) == false) {
							return false;	
						}
					}
				}
			} else {
				// Well, well, well. Looks like the image doesnt exist.
				
				trigger_error("mmhclass->image->is_image(): image does not exist. ({$filename})", E_USER_ERROR);
				
				return false;
			}
			
			return true;
		}
		
		function thumbnail_name($filename)
		{
			$file_extension = $this->file_extension($filename);
			
			$thumbname = sprintf("%s_thumb.%s", $this->basename($filename, ".{$file_extension}"), (($this->manipulator == "gd") ? $file_extension : $file_extension));
			
			return (($this->manipulator == "gd" || $this->manipulator == "imagick" && ($this->mmhclass->funcs->is_file($thumbname, $this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path']) == true || $this->mmhclass->info->config['thumbnail_type'] == "png")) ? $thumbname : sprintf("%s_thumb.jpg", $this->basename($filename, ".{$file_extension}")));
		}
		
		function format_filesize($filesize = 0, $returnbytes = false)
		{
			while (($filesize / 1024) >= 1) { $filesize_count++; $filesize = ($filesize / 1024); } 
			
			$filesize_count = (($this->mmhclass->funcs->is_null($filesize_count)) ? 0 : $filesize_count);
			
			return (($returnbytes == true) ? array("f" => $filesize, "c" => $filesize_count) : (($this->mmhclass->funcs->is_null($filesize) == true || $filesize_count > 9) ?  $this->mmhclass->lang['5454'] : sprintf("%s %s", substr($filesize, 0, (strpos($filesize, ".") + 4)), (($filesize > 0.9 && $filesize < 2.0) ? $this->mmhclass->lang['3103'][$filesize_count] : $this->mmhclass->lang['4191'][$filesize_count]))));
		}
		
		function get_image_info($filename) 
		{
			if ($this->is_image($filename) == false) {
				return false;
			} else {
				if ($this->manipulator == "imagick") {
					$imageh = new Imagick("{$filename}[0]");
					
					return array(
						"mtime" => filemtime($filename),
						"type" => $imageh->getImageType(),
						"bits" => $imageh->getImageLength(),
						"width" => $imageh->getImageWidth(),
						"height" => $imageh->getImageHeight(),
						"comment" => $imageh->getImageProperty("comment"),
						"mime" => sprintf("image/%s", strtolower($imageh->getImageFormat())),
						"html" => sprintf("width=\"%spx;\" height=\"%spx;\"", $imageh->getImageWidth(), $imageh->getImageHeight()),
					);
				} else {
					$base_info = getimagesize($filename);
					
					return array(
						"comment" => NULL,
						"type" => $base_info['2'],
						"html" => $base_info['3'],
						"width" => $base_info['0'],
						"height" => $base_info['1'],
						"mime" => $base_info['mime'],
						"bits" => filesize($filename),
						"mtime" => filemtime($filename),
					);
				}
			}
		}
		
		function scale($filename, $width = 500, $height = 500, $absolute = true) 
		{
			$imageinfo = $this->get_image_info(($absolute == false) ? $filename : $this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$filename);
			
			if ($imageinfo['width'] > $width || $imageinfo['height'] > $height) {
				if ($imageinfo['width'] > $imageinfo['height']) {
					$image_width = $width;
					$image_height = (($imageinfo['height'] * $height) / $imageinfo['width']);
				} elseif ($imageinfo['width'] < $imageinfo['height']) {
					$image_width = (($imageinfo['width'] * $width) / $imageinfo['height']);
					$image_height = $height;
				} elseif ($imageinfo['height'] == $imageinfo['width']) {
					$image_width = $width;
					$image_height = $height;
				}
				
				return array("w" => $image_width, "h" => $image_height);
			} else {
				return array("w" => $imageinfo['width'], "h" => $imageinfo['height']);
			}	
		}
		
		function scaleby_maxwidth($filename, $width = 500, $absolute = true) 
		{
			$imageinfo = $this->get_image_info(($absolute == false) ? $filename : $this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$filename);
			
			if ($imageinfo['width'] > $width) {
				if ($imageinfo['width'] > $imageinfo['height']) {
					$image_width = $width;
					$image_height = round(($imageinfo['height'] * $width) / $imageinfo['width']);
				} elseif ($imageinfo['width'] < $imageinfo['height']) {
					$image_width = round(($imageinfo['width'] * $width) / $imageinfo['height']);
					$image_height = $width;
				} elseif ($imageinfo['height'] == $imageinfo['width']) {
					$image_height = $image_height = $width;
				}
				
				return array("w" => $image_width, "h" => $image_height);
			} else {
				return array("w" => $imageinfo['width'], "h" => $imageinfo['height']);
			}			
		}
		
		function scaleby_maxheight($filename, $height = 500, $absolute = true) 
		{
			$imageinfo = $this->get_image_info(($absolute == false) ? $filename : $this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$filename);
			
			if ($imageinfo['height'] > $height) {
				if ($imageinfo['width'] > $height) {
					$image_width = $imageinfo['width'];
					$image_height = (($height * $height) / $imageinfo['width']);
				} elseif ($imageinfo['width'] < $height) {
					$image_width = (($imageinfo['width'] * $imageinfo['width']) / $height);
					$image_height = $height;
				} elseif ($height == $imageinfo['width']) {
					$image_width = $imageinfo['width'];
					$image_height = $height;
				}
				
				return array("w" => $image_width, "h" => $image_height);
			} else {
				return array("w" => $imageinfo['width'], "h" => $imageinfo['height']);
			}
		}

		function create_thumbnail($filename, $size, $save2disk = true)
		{
			$filename = $this->basename($filename);
				
			if ($this->is_image($this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$filename) == true) {
				$extension = $this->file_extension($filename);
				$thumbnail = $this->thumbnail_name($filename);
				
				if ($save2disk == true) {
				
				//	$thumbnail_size = $this->scale($filename, $this->mmhclass->info->config['thumbnail_width'], $this->mmhclass->info->config['thumbnail_height']);
					
					$thumbnail_size = $this->scale($filename, $size, $size);
					
					if ($this->manipulator == "imagick") {
						// New Design of Advanced Thumbnails created by: Icytexx - http://www.hostili.com
						// Classic Design of Advanced Thumbnails created by: Michael Morris - http://www.imgpizza.com
						
						$canvas = new Imagick();
						$athumbnail = new Imagick();
						
						$imagick_version = $canvas->getVersion();
						$new_thumbnails = ((version_compare($imagick_version['versionNumber'], "1621", ">=") == true) ? true : false);
						
						$athumbnail->readImage("{$this->mmhclass->info->root_path}{$this->mmhclass->info->config['upload_path']}{$filename}[0]");
					
						$athumbnail->flattenImages();
						$athumbnail->orgImageHeight = $athumbnail->getImageHeight();
						$athumbnail->orgImageWidth = $athumbnail->getImageWidth();
						$athumbnail->orgImageSize = $athumbnail->getImageLength();
						$athumbnail->thumbnailImage($thumbnail_size['w'], $thumbnail_size['h']);
						
						if ($this->mmhclass->info->config['advanced_thumbnails'] == true) {
							$thumbnail_filesize = $this->format_filesize($athumbnail->orgImageSize, true);
							$resobar_filesize = (($this->mmhclass->funcs->is_null($thumbnail_filesize['f']) == true || $thumbnail_filesize['c'] > 9) ? $this->mmhclass->lang['5454'] : sprintf("%s%s", round($thumbnail_filesize['f']), $this->mmhclass->lang['7071'][$thumbnail_filesize['c']]));
	
							if ($new_thumbnails == true) {
								$textdraw = new ImagickDraw();
								$textdrawborder = new ImagickDraw();
							
								if ($athumbnail->getImageWidth() > 113) {
									$textdraw->setFillColor(new ImagickPixel("white"));
									$textdraw->setFontSize(9);
									$textdraw->setFont("{$mmhclass->info->root_path}css/fonts/sf_fedora_titles.ttf");
									$textdraw->setFontWeight(900);
									$textdraw->setGravity(8);
									$textdraw->setTextKerning(1);
									$textdraw->setTextAntialias(false);
									
									$textdrawborder->setFillColor(new ImagickPixel("black"));
									$textdrawborder->setFontSize(9);
									$textdrawborder->setFont("{$mmhclass->info->root_path}css/fonts/sf_fedora_titles.ttf");
									$textdrawborder->setFontWeight(900);
									$textdrawborder->setGravity(8);
									$textdrawborder->setTextKerning(1);
									$textdrawborder->setTextAntialias(false);
									
									$array_x = array("-1", "0", "1", "1", "1", "0", "-1", "-1");
									$array_y = array("-1", "-1", "-1", "0", "1", "1", "1", "0");
									
									foreach ($array_x as $key => $value) {
										$athumbnail->annotateImage($textdrawborder, $value, (3 - $array_y[$key]), 0, "{$athumbnail->orgImageWidth}x{$athumbnail->orgImageHeight} - {$resobar_filesize}");
									}

									$athumbnail->annotateImage($textdraw, 0, 3, 0, "{$athumbnail->orgImageWidth}x{$athumbnail->orgImageHeight} - {$resobar_filesize}");
								}
							} else {
								$transback = new Imagick();
								$canvasdraw = new ImagickDraw();
							
								$canvas->newImage($athumbnail->getImageWidth(), ($athumbnail->getImageHeight() + 12), new ImagickPixel("black"));
								$transback->newImage($canvas->getImageWidth(), ($canvas->getImageHeight() - 12), new ImagickPixel("white"));
								
								$canvas->compositeImage($transback, 40, 0, 0);
								$canvasdraw->setFillColor(new ImagickPixel("white"));
								$canvasdraw->setGravity(8);
								$canvasdraw->setFontSize(10);
								$canvasdraw->setFontWeight(900);
								$canvasdraw->setFont("AvantGarde-Demi");
								$canvas->annotateImage($canvasdraw, 0, 0, 0, "{$athumbnail->orgImageWidth}x{$athumbnail->orgImageHeight} - {$resobar_filesize}");
								$canvas->compositeImage($athumbnail, 40, 0, 0); 
								
								$athumbnail = $canvas->clone();
							}
						}
						
						if ($this->mmhclass->info->config['thumbnail_type'] == "jpeg") {
							$athumbnail->setImageFormat("jpeg");
							$athumbnail->setImageCompression(9);
						} else {	
							$athumbnail->setImageFormat("png"); 
						}
						
						$athumbnail->writeImage($this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$thumbnail);
					} else {
						if (in_array($extension, array("png", "gif", "jpg", "jpeg")) == true) {	
							$function_extension = str_replace("jpg", "jpeg", $extension);
							$image_function = "imagecreatefrom{$function_extension}";
							$image = $image_function($this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$filename);
							
							$imageinfo = $this->get_image_info($this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$this->basename($filename));
							$thumbnail_image = imagecreatetruecolor($thumbnail_size['w'], $thumbnail_size['h']);
							imagecopyresampled($thumbnail_image, $image, 0, 0, 0, 0, $thumbnail_size['w'], $thumbnail_size['h'], $imageinfo['width'], $imageinfo['height']);
	
							$image_savefunction = sprintf("image%s", (($this->mmhclass->info->config['thumbnail_type'] == "jpeg") ? "jpeg" : "png"));
							$image_savefunction($thumbnail_image, $this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$thumbnail);
							chmod($this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$thumbnail, 0644);
							
							imagedestroy($image);	
							imagedestroy($thumbnail_image); 
						}
					}
					
					chmod($this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$thumbnail, 0644);
				} else {
					readfile($this->mmhclass->info->root_path.$this->mmhclass->info->config['upload_path'].$thumbnail);
				}
			}
		}
	}
	
?>