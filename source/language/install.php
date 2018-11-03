<?php
/* 
     // ======================================== \
     // Package: ImgPizza
     // Version: 5.0.0
     // Copyright (c) 2007, 2008, 2009 Mihalism Technologies
     // License: http://www.gnu.org/licenses/gpl.txt GNU Public License
     // LTE: 1251507848 - Friday, August 28, 2009, 09:04:08 PM EDT -0400
     // ======================================== /
     
     This file contains some language settings that are a part of ImgPizza but were not able to 
     be placed into template files. In each setting, %s represents a place holder for a value that will 
     be dynamically generated by ImgPizza; so be careful while editing to not remove them.
     
     Language file index:
		001 -- Page title for the ImgPizza installer
		002 -- Error to be displayed if someone tries to access installer after installation
		003 -- Error to be displayed if not all form fields are filled in
		004 -- Error to be displayed if the entered email is invalid
		005 -- Error to be displayed if an invalid password is given
		006 -- Error to be displayed if the given passwords do not match
		007 -- Error to be displayed if the given username is not valid
		008 -- Error to be displayed if write permission is not given to file
		009 -- Error to be displayed if write permission is not given to folder
		010 -- Error to be displayed if the configuration file cannot be created
		011 -- Message to be displayed when website is done installing
		903 -- Error to be displayed if MySQL connect fails

*/
    
	$mmhclass->lang['001'] = "ImgPizza » Installation";
	$mmhclass->lang['002'] = "This installer is disabled because an installation of ImgPizza already exists.<br />
To reinstall ImgPizza please empty the file <b>source/includes/config.php</b><br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['003'] = "The form on the previous page has not been filled in completely. <br />
One or more fields have been left blank. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['004'] = "The email address <b>%s</b> appears to be in an invalid format.<br />
A valid address would look like: <b>username@example.com</b>.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['005'] = "The administrator password entered is not valid based on the specified requirements. <br />
It is either too long or too short. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['006'] = "The administrator password entered is not equal to its confirmation field. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['007'] = "The administrator username entered is not valid based on the specified requirements.<br />
It either is too long, too short, or contains forbidden characters. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['008'] = "Please ensure the file <b>source/includes/config.php</b> has the ability to be read and written to. <br />
A good permission level is: 0777. Change the permission via SSH or FTP and try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['009'] = "Please ensure the folder <b>images/</b> has the ability to be read and written to. <br />
A good permission level is: 0777. Change the permission via SSH or FTP and try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['010'] = "Failed to write to the file <b>source/includes/config.php</b>. Please ensure the file is writable. <br />
A good permission level is: 0777. Change the permission via SSH or FTP and try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['011'] = "This website has been successfully installed. <br />
<br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['903'] = "Failed to connect to MySQL Database Server.<br />
Please check log in information and try again. <br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";


?>