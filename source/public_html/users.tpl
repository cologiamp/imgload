<!-- BEGIN: USER REGISTRATION PAGE -->
<template id="registration_page">

<div id="content" class="container-fluid">
<div class="container">
<div class="row" id="main">
<div class="col-sm-6 sign-up-form-holder">
<h3 class="other-title-bold">Create an account</h3>
<form id="register-form" class="quick-form" action="users.php?act=register-d" method="post">
<input type="hidden" name="_csrf" value="ZFVxYTcxTGxQYRcUb2UdJi1iABVFRRgANRpJV1B1KSlQO0VQYkgUIQ=="> <div class="form-group field-registerform-email required">
<label class="control-label" for="registerform-email">Email address</label>
<input type="email" id="registerform-email" class="form-control" name="email_address">
<p class="help-block help-block-error"></p>
</div> <div class="form-group field-registerform-password required">
<label class="control-label" for="registerform-password">Password</label>
<input type="password" id="registerform-password" class="form-control" name="password" aria-autocomplete="list">
<p class="help-block help-block-error"></p>
</div> <div class="form-group field-registerform-passwordconfirm required">
<label class="control-label" for="registerform-passwordconfirm">Confirm Password</label>
<input type="password" id="registerform-passwordconfirm" class="form-control" name="password-c">
<p class="help-block help-block-error"></p>
</div> <div class="form-group field-registerform-recaptcha">
<label class="control-label" for="registerform-recaptcha">Captcha</label>
<input type="hidden" id="registerform-recaptcha" name="RegisterForm[reCaptcha]"><div class="g-recaptcha" data-sitekey="6LckIAQTAAAAAFLTuNjHVDyPq2JQT5qKKFUlQFa3" data-callback="recaptchaCallback" data-expired-callback="recaptchaExpiredCallback"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LckIAQTAAAAAFLTuNjHVDyPq2JQT5qKKFUlQFa3&amp;co=aHR0cHM6Ly9vcGVubG9hZC5jbzo0NDM.&amp;hl=en&amp;v=v1537165899310&amp;size=normal&amp;cb=wt7rhsbw8zk3" width="304" height="78" role="presentation" name="a-hpu7q2py9mxo" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;  display: none; "></textarea></div></div>
<p class="help-block help-block-error"></p>
</div> <div class="form-group field-registerform-iagree required">
<div class="checkbox">
<label for="registerform-iagree">
<input type="hidden" name="RegisterForm[iagree]" value="0"><input type="checkbox" id="registerform-iagree" name="RegisterForm[iagree]" value="1">
I agree on Openload terms.
</label>
<p class="help-block help-block-error"></p>
</div>
</div> <div class="s-submit">
<button type="submit">Sign Up</button> </div>
</form></div>
<div class="col-sm-6 sign-up-features-holder">
<h2>Get your stuff loaded.</h2>
<div class="feature"><img src="./css/images/money.png" width="100" height="100"><h2>Free.</h2></div>
<div class="feature"><img src="./css/images/speed.png" width="100" height="100"><h2>Fast.</h2></div>
<div class="feature"><img src="./css/images/unlimited.png" width="100" height="100"><h2>Unlimited.</h2></div>
</div>
</div>
</div>
</div>


</template>
<!-- END: USER REGISTRATION PAGE -->

<!-- BEGIN: USER REGISTRATION HARD LIMIT EMAIL -->
<template id="user_registration_hard_limit">

<# SITE_NAME #> Administrator,
<br /><br />
The hard limit of 5 user accounts per IP address has<br />
been exceeded by the user with the IP address: <a href="http://whois.domaintools.com/<# IP_ADDRESS #>"><# IP_ADDRESS #></a>.
<br /><br />
To take action, log in to the Admin Control Panel at:
<br /><br />
<# BASE_URL #>admin.php

</template>
<!-- END: USER REGISTRATION HARD LIMIT EMAIL -->

<!-- BEGIN: USER LOGIN LIGHTBOX -->
<template id="login_lightbox">

<form action="users.php?act=login-d" method="post">
	<input type="hidden" name="return" value="<# RETURN_URL #>" />
    
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%; background: #ebf1f5;">
		<tr>
            <th colspan="2">Log In</th>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td class="text_align_right" style="width: 45%;"><span>Username</span>:&nbsp;</td> 
            <td><input type="text" name="username" class="input_field" style="width: 200px;" /></td>
        </tr>
        <tr>
         	<td class="text_align_right" style="width: 45%;"><span>Password</span>:&nbsp;</td>
            <td><input type="password" name="password" class="input_field" style="width: 200px;" /></td>
        </tr>
        <tr>
            <td class="text_align_center" style="height: 45px;" colspan="2">
            	<input type="submit" value="Log In" class="btn btn-primary" />
           	</td>
        </tr>
        <tr>
            <td class="text_align_center" style="font-size: 10px;" colspan="2">
                ( <a href="javascript:void(0);" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>'); toggle_lightbox('users.php?act=lost_password', 'lost_password_lightbox');">Reset Password</a> | 
                <a href="users.php?act=register&amp;return=<# RETURN_URL #>">Register</a> )
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td class="table_footer" colspan="2"><a style="cursor: pointer;" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
        </tr>
    </table>
</form>

</template>
<!-- END: USER LOGIN LIGHTBOX -->

<!-- BEGIN: FORGOTTEN PASSWORD LIGHTBOX -->
<template id="forgotten_password_lightbox">

<form action="users.php?act=lost_password-d" method="post">
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%; background: #ebf1f5;">
		<tr>
			<th colspan="2">Reset My Password</th>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="text_align_right" style="width: 45%;"><span>Username</span>:&nbsp;</td> 
			<td><input type="text" name="username" class="input_field" style="width: 200px;" /></td>
		</tr>
		<tr>
			<td class="text_align_right" style="width: 45%;"><span>E-Mail Address</span>:&nbsp;</td> 
			<td><input type="text" name="email_address" class="input_field" style="width: 200px;" /></td>
		</tr>
		<tr>
			<td colspan="2" class="text_align_center" style="height: 45px;">
            	<input type="submit" value="Send Password" class="btn btn-primary" />
          </td>
		</tr>
		<tr>
			<td colspan="2" class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
		</tr>
	</table>
</form>

</template>
<!-- END: FORGOTTEN PASSWORD LIGHTBOX -->

<!-- BEGIN: FORGOTTEN PASSWORD EMAIL -->
<template id="forgotten_password_email">

Hello <# USERNAME #>,
<br /><br />
You are receiving this email because you have (or someone pretending to be you has) requested<br />
a new password be set for your account on <a href="<# BASE_URL #>"><# SITE_NAME #></a>. If you did not request this email,<br />
then please ignore it, and if you keep receiving it, then please <a href="<# BASE_URL #>contact.php?act=contact_us">contact the site administrator</a>.
<br /><br />
To use the new password you need to activate it. To do this click the link provided below.
<br /><br />
<a href="<# BASE_URL #>users.php?act=lost_password-a&id=<# AUTH_KEY #>">Activate New Password</a>
<br /><br />
If successful you will be able to log in using the following information:
<br /><br />
<strong>Username:</strong> <# USERNAME #><br />
<strong>Password:</strong> <# NEW_PASSWORD #>
<br /><br />
<em>Please keep in mind that the password you enter is case sensitive.</em>
<br /><br />
----<br />
<# SITE_NAME #> Support<br />
<# ADMIN_EMAIL #>

</template>
<!-- END: FORGOTTEN PASSWORD EMAIL -->

<!-- BEGIN: USER LIST PAGE -->
<template id="user_list_page">

<# PAGINATION_LINKS #>
<br /><br />

<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<td>
			</td>
		</tr>
        
        
		<tr>
			<td colspan="5" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- END: USER LIST PAGE -->

<!-- BEGIN: MY GALLERY PAGE -->
<template id="my_gallery_page">

<div id="content" class="container-fluid">
<div class="container">
<div class="row" id="main">
<div class="col-xs-12 content-faq">
<h1><# GALLERY_OWNER #>'s Gallery <# ALBUM_NAME #></h1>

<div class="align_left_mfix" style="height: 30px;">

    <ul class="jd_menu" style="float: right;">
        <if="$mmhclass->info->user_owned_gallery == true">
     		<li><span onclick="gallery_action('delete');" title="Delete Selected" class="btn btn-primary">Delete Images</span></li>
            <li><span onclick="gallery_action('move');" title="Move Selected" class="btn btn-primary">Move Images</span></li>
      		<li><span onclick="gallery_action('select');" title="Select/Deselect All" class="btn btn-primary">Select All</span></li>
        </endif>
        
      	<li><span class="btn btn-primary">Album List</span>
            <ul class="menu_border">
                <if="$mmhclass->info->user_owned_gallery == true">
                    <li class="header">Actions</li>
                    <li class="item"><a href="javascript:void(0);" onclick="toggle_lightbox('users.php?act=albums-c', 'new_album_lightbox');">New Album</a></li>
                </endif>
                
                <li class="header">Albums</li>
                <li class="item"><a href="<# GALLERY_URL #>">Root Album</a> (<# TOTAL_ROOT_UPLOADS #> of <# TOTAL_UPLOADS #> images)</li>
                
                <while id="album_pulldown_whileloop">
                    <li class="item"> 
                        <strong>&bull;</strong> <a href="<# GALLERY_URL #>&amp;cat=<# ALBUM_ID #>"><# ALBUM_NAME #></a> (<# TOTAL_UPLOADS #> images) 
                       
                        <if="$mmhclass->info->user_owned_gallery == true">
                            ( <a href="javascript:void(0);" onclick="toggle_lightbox('users.php?act=albums-d&amp;album=<# ALBUM_ID #>', 'delete_album_lightbox');">Delete</a> |
                            <a href="javascript:void(0);" onclick="toggle_lightbox('users.php?act=albums-r&amp;album=<# ALBUM_ID #>', 'rename_album_lightbox');">Rename</a> )
                        </endif>
                    </li>
                </endwhile>
      		</ul>
      	</li>
        
        <if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['search']) == true">
            <li><span class="btn btn-primary">Search</span>
                <ul class="menu_border">
                    <li class="header">Search this Album</li>
                    <li class="item text_align_center">
                        <input type="text" id="file_search" class="input_field" maxlength="25" style="width: 130px;" value="Enter Filename or Title" onclick="$(this).val('');" onkeydown="if(event.keyCode==13){$('input[id=file_search_button]').click();}" />
                        <input type="button" value="Go" id="file_search_button" onclick="location.href=('<# FULL_GALLERY_URL #>&amp;search=' + encodeURIComponent($('input[id=file_search]').val()));" />
                        <br /><br />
                        <b>%</b> and <b>_</b> are <a href="http://dev.mysql.com/doc/refman/5.0/en/string-comparison-functions.html#operator_like" target="_blank">wildcard characters</a>.
                    </li>
                </ul>
            </li>
        <else>
        	<li><a href="<# FULL_GALLERY_URL #>" class="btn btn-primary">Clear Search</a></li>
        </endif>
    </ul>

</div>

<!--
<# PAGINATION_LINKS #>
-->
<br /><br />

<if="$mmhclass->templ->templ_globals['empty_gallery'] == true">
	<# EMPTY_GALLERY #>
<else>
        <table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
            <tr>
	            <th colspan="4">
            		<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['search']) == true">
               			
      				<else>
                    	Searching for "<# IMAGE_SEARCH #>"
                	</endif>
                </th>
            </tr>
            <tr>
                <# GALLERY_HTML #>
            </tr>
            <tr>
                <td colspan="4" class="table_footer">&nbsp;</td>
            </tr>
        </table>
<script>
     $(document).ready(function(){
	$('textarea#links_target').val("");
	$('textarea#forum_links_target').val("");
	$('textarea#html_links_target').val("");
	$('input[type="checkbox"]').change(function() {
		links = $('textarea#links_target');
		forum_links = $('textarea#forum_links_target');
		html_links = $('textarea#html_links_target');

		old_links = links.val();
		old_forum_links = forum_links.val();
		old_html_links = html_links.val();

		if(!$(this).attr('checked'))
		{
			links.val(old_links.replace($(this).attr('link1') + "\n", ''));
			forum_links.val(old_forum_links.replace($(this).attr('link2') + " ", ''));
			html_links.val(old_html_links.replace($(this).attr('link3') + " ", ''));
		}
		else
		{
			links.val(old_links + $(this).attr('link1') + "\n");
			forum_links.val(old_forum_links + $(this).attr('link2') + " ");
			html_links.val(old_html_links + $(this).attr('link3') +" ");
		}
	});
     });
   </script>
   <div class="pagination_footer">
        <# PAGINATION_LINKS #>
   </div>

   <br /> <div class="textareag"><TABLE BORDER=0 CELLPADDING=0>
<TR rowspan=3> <TH class="table_header2 faqtitulo">&nbsp;Links:</TH><TH class="table_header2 faqtitulo">&nbsp;Forum Links:</TH><TH class="table_header2 faqtitulo" >&nbsp;HTML Links:</TH> </TR>
<TD style="border:0;">
<div class="form-group">
	<textarea class="form-control" onclick="highlight(this);"  class="forum_links_target input_field" id="links_target" cols="45" rows="10"></textarea>
</div>
</TD>
<TD style="border:0;">
<div class="form-group">
	<textarea class="form-control" onclick="highlight(this);"  class="forum_links_target input_field" id="forum_links_target" cols="45" rows="10"></textarea>
</div>
</TD>
<TD style="border:0;">
 <textarea class="form-control" onclick="highlight(this);"  class="forum_links_target input_field" id="forum_links_target" cols="45" rows="10"></textarea> 
</TD>
</TR>
</TABLE>    </div>

</endif>

</div> 
</div>
</div>
</div>


</template>
<!-- END: MY GALLERY PAGE -->

<!-- BEGIN: MOVE FILES LIGHTBOX -->
<template id="move_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Move Images</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="users.php?act=move_files-d" method="post">
				<p>
					<b>Move To</b>:
					<br /><br />
                    
					<select name="move_to" style="width: 200px;">
						<option value="root">Root Album</option>
                        
						<while id="album_options_whileloop">
							<option value="<# ALBUM_ID #>">&bull; <# ALBUM_NAME #></option>
						</endwhile>
					</select>
					<br /><br />
                    
					<input type="hidden" value="<# FILES2MOVE #>" name="files" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
                    
					<input type="submit" value="Move Images" class="btn btn-primary" />
					<input type="button" value="Cancel" class="btn btn-primary" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: MOVE FILES LIGHTBOX -->

<!-- BEGIN: DELETE FILES LIGHTBOX -->
<template id="delete_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Confirm Image Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="users.php?act=delete_files-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
                    
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="hidden" value="<# FILES2DELETE #>" name="files" />
                    
					<input type="submit" value="Yes" class="btn btn-primary" />
					<input type="button" value="No" class="btn btn-primary" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: DELETE FILES LIGHTBOX -->

<!-- BEGIN: NEW ALBUM LIGHTBOX -->
<template id="new_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>New Album</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="users.php?act=albums-c-d" method="post">
				<p>
					<b>Album Title</b>:
					<br /><br />
                    
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" />
					<br /><br />
                    
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
                    
					<input type="submit" value="Create Album" class="btn btn-primary" />
					<input type="button" value="Cancel" class="btn btn-primary" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: NEW ALBUM LIGHTBOX -->

<!-- BEGIN: RENAME ALBUM LIGHTBOX -->
<template id="rename_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Rename Album</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="users.php?act=albums-r-d" method="post">
				<p>
					<b>New Album Title</b>:
					<br /><br />
                    
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" value="<# OLD_TITLE #>" onclick="$(this).val('');" />
					<br /><br />
                    
					<input type="hidden" value="<# ALBUM_ID #>" name="album" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
                    
					<input type="submit" value="Rename Album" class="btn btn-primary" />
					<input type="button" value="Cancel" class="btn btn-primary" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
				</p>
	    	</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: RENAME ALBUM LIGHTBOX -->

<!-- BEGIN: DELETE ALBUM LIGHTBOX -->
<template id="delete_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Confirm Album Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="users.php?act=albums-d-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
                    
					<input type="hidden" value="<# ALBUM2DELETE #>" name="album" />
                    
					<input type="submit" value="Yes" class="btn btn-primary" />
					<input type="button" value="No" class="btn btn-primary" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
                    <br /><br />
                    
					<div style="font-size: 10px; font-style: italic;">
                    	<strong>Note:</strong> Images within this album will be moved to the root album, not deleted.
                    </span>
				</p>
			</form>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: DELETE ALBUM LIGHTBOX -->

<!-- BEGIN: USER SETTINGS PAGE -->
<template id="user_settings_page">
<div id="content" class="container-fluid">
<div class="container">
<div class="row" id="main">
<div class="col-xs-12 col-md-7 contact-form-holder col-centered">
<h1>User Settings</h1>

<form action="users.php?act=settings-s" method="post" role="form">
	<input type="hidden" name="return" value="<# RETURN_URL #>" />
	<input type="hidden" value="<# REFEREDBY #>" name="referedby" />

	<div class="form-group field-contactform-name required">
	<label class="control-label" for="username">Username: </label>
	<input type="text" id="username" class="form-control" readonly name="username" value="<# USERNAME #>">
	</div>

	<div class="form-group required">
	<label class="control-label" for="password">Password: </label>
	<input type="password" id="password" class="form-control" name="password" maxlength="30" value="*************">
	</div>


	<div class="form-group field-contactform-realsubject required">
	<label class="control-label" for="email_address">E-mail Address: </label>
	<input type="email" id="email_address" class="form-control" name="email_address" value="<# EMAIL_ADDRESS #>">
	</div>

	<div class="form-group field-contactform-realsubject required">
	<label class="control-label" for="paypal_address">Paypal Account: </label>
	<input type="email" id="paypal_address" class="form-control" name="paypal_address" value="<# PAYPAL_ADDRESS #>">
	</div>

	<div class="form-group field-contactform-realsubject required">
	<label class="control-label" for="payza_address">Payza Account: </label>
	<input type="email" id="payza_address" class="form-control" name="payza_address" value="<# PAYZA_ADDRESS #>">
	</div>

	<div class="form-group field-contactform-name required">
	<label class="control-label" for="time_joined">Date Registered: </label>
	<input type="text" id="time_joined" class="form-control" readonly name="time_joined" value="<# TIME_JOINED #>">
	</div>

	<div class="submitcontainer" style="margin-top: 20px; text-align: right; width: 100%;">
	<button type="submit" class="btn btn-primary" name="contact-button">Send</button>
	</div>

</form>
</div>
</div>
</div>
</div>

</template>
<!-- END: USER SETTINGS PAGE -->