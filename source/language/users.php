<?php
/* 
     // ======================================== \
     // Package: ImgPizza
     // Version: 5.0.0
     // Copyright (c) 2007, 2008, 2009 Mihalism Technologies
     // License: http://www.gnu.org/licenses/gpl.txt GNU Public License
     // LTE: 1403964532 - Saturday, June 28, 2014, 10:08:52 AM EDT -0400
     // ======================================== /
     
     This file contains some language settings that are a part of ImgPizza but were not able to 
     be placed into template files. In each setting, %s represents a place holder for a value that will 
     be dynamically generated by ImgPizza; so be careful while editing to not remove them.
     
     Language file index:
		001 -- Default page title for user related pages
		002 -- Error to be displayed if a page requires an user to be logged in
		003 -- Extended page title for the user settings page
		004 -- Error to be displayed if a form has not been filled in completely
		005 -- Error to be displayed if an email address is invalid
		006 -- Error to be displayed if an invalid password is supplied
		007 -- Error to be displayed if an email address is already in use
		008 -- Message to be displayed when user settings have been changed
		009 -- Catch all error for nonexistent pages
		010 -- Group title for administrators
		011 -- Group title for normal users
		012 -- Group title for the root administrator
		013 -- Error to be displayed if not all input parameters (GET/POST) are supplied
		014 -- Error to be displayed if an album is unable to be deleted
		015 -- Extended page title for the delete album page
		016 -- Message to be displayed when an album has been deleted
		017 -- Error to be displayed if an album is unable to be renamed
		018 -- Extended page title for the rename album page
		019 -- Message to be displayed when an album has been renamed
		020 -- Extended page title for the new album page
		021 -- Message to be displayed when a new album has been created
		022 -- Error to be displayed when an album name is already in use
		023 -- Error to be displayed when no filename is supplied
		024 -- Error to be displayed when an image does not exist
		025 -- This language setting is no longer in use by ImgPizza
		026 -- Extended page title for the delete images page
		027 -- Error to be displayed when an image is not able to be deleted
		028 -- Error to be displayed when the thumbnail of an image is not able to be deleted
		029 -- Message to be displayed when an image has been deleted
		030 -- This language setting is no longer in use by ImgPizza
		031 -- Extended page title for the move images page
		032 -- Message to be displayed when an image has been moved
		033 -- Extended page title for an user gallery page
		034 -- Extended page title for the user galleries list
		035 -- Notice to be displayed if a gallery is private
		036 -- Notice to be displayed if a gallery is public
		037 -- Extended page title for log out page
		038 -- Message to be displayed when an user has been logged out
		039 -- Error to be displayed when log out fails
		040 -- Message to be displayed when registration is disabled
		041 -- Extended page title for user registration page
		042 -- Error to be displayed when a password does not match its confirmation field
		043 -- Error to be displayed when an invalid username is supplied
		044 -- Error to be displayed when an username is already in use
		045 -- Message to be displayed when an user has registered
		046 -- Extended page title for the user log in page
		047 -- Error to be displayed if invalid log in is supplied
		048 -- Message to be displayed when an user has logged in
		049 -- Error to be displayed when user log in has failed
		050 -- Extended page title for the user password reset page
		051 -- Error to be displayed if an invalid account is supplied to password reset page
		052 -- Email subject for password reset email
		053 -- Message to be displayed when a password reset activation email is sent
		054 -- Error to be displayed when an email is not able to be sent
		055 -- Extended page title for reset password activation page
		056 -- Error to be displayed if an invalid activation key is supplied
		057 -- Message to be displayed when an user password has been reset
		058 -- Message to be displayed when a gallery is empty
		059 -- Message to be displayed when a gallery is set to private
		060 -- This language setting is no longer in use by ImgPizza
		061 -- Error to be displayed when an invalid reCAPTCHA code is supplied
		062 -- Error to be displayed if a gallery does not exist
		675 -- Message to be displayed if no image search results are returned
		992 -- Error to be displayed if an IP Address tries to create more than 5 accounts
		704 -- Email subject to be used when user registration hard limit is exceeded
		949 -- Error to be displayed if album does not exist when moving images

*/
    
	$mmhclass->lang['001'] = "%s - ";
	$mmhclass->lang['002'] = "You must be logged in to view this page. <br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['003'] = "User Settings - %s";
	$mmhclass->lang['004'] = "The form on the previous page has not been filled in completely. <br />
One or more fields have been left blank. Please try again. <br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['005'] = "The email address <b>%s</b> appears to be in an invalid format.<br />
A valid address would look like: <b>username@example.com</b>.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['006'] = "The password entered is not valid based on the specified requirements. <br />
It is either too long or too short. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['007'] = "The email address <b>%s</b> is already in use. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['008'] = "Settings have been successfully updated.<br />
<br />
<a href=\"users.php?act=settings\">Edit Settings Again</a><br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['009'] = "You have reached this page in error. Please use your back button to return to the previous page.";
	$mmhclass->lang['010'] = "Administrator";
	$mmhclass->lang['011'] = "Normal User";
	$mmhclass->lang['012'] = "Root Administrator (Owner)";
	$mmhclass->lang['013'] = "An invalid number of input parameters (<a href=\"http://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol#Request_methods\">GET / POST</a>) have been supplied.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['014'] = "The requested album is unable to be deleted.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['015'] = "Delete Album";
	$mmhclass->lang['016'] = "The requested album has been successfully deleted.<br />
<br />
<a href=\"users.php?act=gallery\">Return to My Gallery</a><br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['017'] = "The requested album is unable to be renamed.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['018'] = "Rename Album";
	$mmhclass->lang['019'] = "The album <b>%s</b> has been successfully renamed to <b>%s</b>.<br />
<br />
<a href=\"index.php?rurl=%s\">Return to Previous Page</a><br />
<a href=\"users.php?act=gallery&cat=%s\">Go to Renamed Album</a><br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['020'] = "New Album";
	$mmhclass->lang['021'] = "The album <b>%s</b> has been successfully created.<br />
<br />
<a href=\"index.php?rurl=%s\">Return to Previous Page</a><br />
<a href=\"users.php?act=gallery&cat=%s\">Go to New Album</a><br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['022'] = "The album name <b>%s</b> is already in use. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['023'] = "No filename has been supplied.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['024'] = "The image file <b>%s</b> does not exist. <br />
Please ensure the filename is spelled correctly.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['025'] = "";
	$mmhclass->lang['026'] = "Delete Images";
	$mmhclass->lang['027'] = "The image file <b>%s</b> is unable to be deleted.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['028'] = "The thumbnail of the image file <b>%s</b> could not be deleted.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['029'] = "Images have been successfully deleted.<br />
<br />
<a href=\"index.php?rurl=%s\">Return to Previous Page</a><br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['030'] = "";
	$mmhclass->lang['031'] = "Move Images";
	$mmhclass->lang['032'] = "Images have been successfully moved.<br />
<br />
<a href=\"index.php?rurl=%s\">Return to Previous Page</a><br />
<a href=\"users.php?act=gallery&cat=%s\">Go to New Album</a><br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['033'] = "My Gallery";
	$mmhclass->lang['034'] = "User Galleries";
	$mmhclass->lang['035'] = "Private";
	$mmhclass->lang['036'] = "Public";
	$mmhclass->lang['037'] = "Log Out";
	$mmhclass->lang['038'] = "You have been successfully logged out.<br />
<br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['039'] = "Log out failed!";
	$mmhclass->lang['040'] = "Registration is currently disabled. <br />
For more information <a href=\"contact.php?act=contact_us\">contact us</a>.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['041'] = "User Registration";
	$mmhclass->lang['042'] = "The password entered is not equal to its confirmation field. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['043'] = "The username entered is not valid based on the specified requirements.<br />
It either is too long, too short, or contains forbidden characters. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['044'] = "The username <b>%s</b> is already in use. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['045'] = "<b>%s</b>, your account has been have successfully created.<br />
You can now log in by clicking above to begin uploading.<br />
<br />
<a href=\"index.php?rurl=%s\">Return to Previous Page</a><br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['046'] = "Log In";
	$mmhclass->lang['047'] = "No user account was found matching the information provided. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['048'] = "You have been successfully logged in.<br />
<br />
<a href=\"users.php?act=gallery\">My Gallery</a><br />
<a href=\"index.php?rurl=%s\">Return to Previous Page</a>";
	$mmhclass->lang['049'] = "Log in failed!";
	$mmhclass->lang['050'] = "Password Recovery";
	$mmhclass->lang['051'] = "No user account was found matching the information provided. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['052'] = "Password Recovery Activation at %s (#%s)";
	$mmhclass->lang['053'] = "An activation email has been sent to the email address: <b>%s</b>.<br />
No change to the current password will occur until the link in the email has been clicked.<br />
<br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['054'] = "Failed to send email due to an error with the mail server. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['055'] = "Password Recovery Activation";
	$mmhclass->lang['056'] = "Password could not be reset because the activation key supplied does not exist or has already been used.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['057'] = "Password has been successfully reset. <br />
<br />
<a href=\"index.php\">Site Index</a>";
	$mmhclass->lang['058'] = "Gallery is empty.";
	$mmhclass->lang['059'] = "Viewing of this gallery has been set to private. <br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['060'] = "";
	$mmhclass->lang['061'] = "The security code entered did not match the one displayed. <br />
A new code has been generated. Please try again.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['062'] = "You have reached this page in error. Please use your back button to return to the previous page.";
	$mmhclass->lang['675'] = "No results found.";
	$mmhclass->lang['992'] = "Sorry, but there is a hard limit of <b>5</b> user accounts per IP address. <br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";
	$mmhclass->lang['704'] = "User Registration Limit Exceeded";
	$mmhclass->lang['949'] = "Destination album does not exist.<br />
<br />
<a href=\"javascript:void(0);\" onclick=\"history.go(-1);\">Return to Previous Page</a>";


?>