<?php
/* 
     // ======================================== \
     // Package: ImgPizza
     // Version: 5.0.0
     // Copyright (c) 2007, 2008, 2009 Mihalism Technologies
     // License: http://www.gnu.org/licenses/gpl.txt GNU Public License
     // LTE: 1248926073 - Wednesday, July 29, 2009, 10:54:33 PM CDT -0500
     // ======================================== /
     
     This file contains some language settings that are a part of ImgPizza but were not able to 
     be placed into template files. In each setting, %s represents a place holder for a value that will 
     be dynamically generated by ImgPizza; so be careful while editing to not remove them.
     
     Language file index:
		001 -- Page title for viewer page
		002 -- Error to be displayed if no filename is given
		003 -- Error to to displayed if the given filename does not exist
		004 -- Error to be displayed if an image cannot be displayed
		005 -- Error to be displayed if a person tries to rate an image multiple times
		006 -- Message to be displayed on a successful image rating submission

*/
    
	$mmhclass->lang['001'] = "%s » Image Viewer";
	$mmhclass->lang['002'] = "No filename has been supplied.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['003'] = "The image file <b>%s</b> does not exist. <br />
Please ensure the filename is spelled correctly.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['004'] = "The requested file is not a true image and therefore could not be displayed. <br />
Click <a href=\"download.php?file=%s\">here</a> to download the file.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['005'] = "You have already rated this image.";
	$mmhclass->lang['006'] = "Your rating has been successfully submitted. <br />
Below is the updated overall rating.<br />
<br />
<img src=\"index.php?module=rating&file=%s\" alt=\"File Rating\" />";


?>