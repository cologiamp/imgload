<!-- BEGIN: ACP STYLE #74766 -->
<template id="system_info_page">

<div class="table_border">
    <table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
        <tr>
            <th colspan="2">System Information</th>
        </tr>
        <tr>
        	<td colspan="2" class="tdrow1">
            	<strong>Important:</strong> Some information presented on this page may not be accurate or available in shared hosting environments. 
            </td>
        </tr>
        <tr>
        	<td style="width: 38%;" class="tdrow1"><span>Operating System:</span></td> 
        	<td class="tdrow2">
            
        		<if="$mmhclass->templ->templ_globals['show_uptime_info'] == true">
            		<pre><# VERSION_INFO #></pre>
            	<else>
                	<em>Failed to generate report.</em>
                </endif>
                
            </td>
        </tr>
        <tr>
            <td style="width: 38%;" class="tdrow1"><span>System Build:</span> <br /> <div class="explain">uname is a software program in Unix and Unix-like computer operating systems that prints the name, version and other details about the current machine and the operating system running on it.</div></td> 
            <td class="tdrow2" valign="top"><pre><# SYSTEM_BUILD #></pre></td>
        </tr>
        <tr>
        	<td style="width: 38%;" class="tdrow1"><span>System Uptime:</span></td> 
        	<td class="tdrow2">
            
        		<if="$mmhclass->templ->templ_globals['show_uptime_info'] == true">
            		System has been online for <# UPTIME_TOTAL #> days. 
            	<else>
                	<em>Failed to generate report.</em>
                </endif>
                
            </td>
        </tr>
        <tr>
        	<td style="width: 38%;" class="tdrow1"><span>CPU Load Average:</span> <br /> <div class="explain">In UNIX computing, the system load is a measure of the amount of work that a computer system performs. The load average represents the average system load over a period of time. It conventionally appears in the form of three numbers which represent the system load during the last one, five, and fifteen -minute periods.</div></td> 
        	<td class="tdrow2" valign="top">
            
        		<if="$mmhclass->templ->templ_globals['show_cpu_usage'] == true">
            		<# CPU_LOAD_1m #> (1 min) <# CPU_LOAD_5m #> (5 mins) <# CPU_LOAD_15m #> (15 mins)
            	<else>
                	<em>Failed to generate report.</em>
                </endif>
                
            </td>
        </tr>
        <tr>
            <td style="width: 38%;" class="tdrow1" valign="top"><span>Disk Space Usage:</span></td> 
            <td class="tdrow2">
                <div class="disk_loadbar"><img src="css/images/loadbar_red.gif" style="height: 16px; width: <# DISK_USAGE_IMAGE_WIDTH #>px;" /><img src="css/images/loadbar_blue.gif" style="height: 16px; width: <# DISK_USAGE_IMAGE_WIDTH_2 #>px;" /></div><br />
                <# DISK_USAGE_USED_SPACE #> of <# DISK_USAGE_TOTAL_SPACE #> used. 
            </td>
        </tr>
        <tr>
            <td style="width: 38%;" class="tdrow1" valign="top"><span>Memory Usage:</span></td> 
            <td class="tdrow2">
            
                <if="$mmhclass->templ->templ_globals['show_ram_usage'] == true">
                	<div class="disk_loadbar"><img src="css/images/loadbar_red.gif" style="height: 16px; width: <# RAM_USAGE_IMAGE_WIDTH #>px;" /><img src="css/images/loadbar_blue.gif" style="height: 16px; width: <# RAM_USAGE_IMAGE_WIDTH_2 #>px;" /></div><br />
               		<# RAM_USAGE_USED_SPACE #> of <# RAM_USAGE_TOTAL_SPACE #> used. 
                <else>
                    <em>Failed to generate report.</em>
                </endif>
                
            </td>
        </tr>
        <tr>
            <td style="width: 38%;" class="tdrow1" valign="top"><span>Virtual Memory Usage:</span></td> 
            <td class="tdrow2">
            
                <if="$mmhclass->templ->templ_globals['show_swap_usage'] == true">
                	<div class="disk_loadbar"><img src="css/images/loadbar_red.gif" style="height: 16px; width: <# SWAP_USAGE_IMAGE_WIDTH #>px;" /><img src="css/images/loadbar_blue.gif" style="height: 16px; width: <# SWAP_USAGE_IMAGE_WIDTH_2 #>px;" /></div><br />
               		<# SWAP_USAGE_USED_SPACE #> of <# SWAP_USAGE_TOTAL_SPACE #> used. 
                <else>
                    <em>Failed to generate report.</em>
                </endif>
                
            </td>
        </tr>
        <tr>
        	<td class="table_footer" colspan="2">&nbsp;</td>
        </tr>
    </table>
</div><br />

<em><strong>Credit:</strong> The description of each item presented above were obtained from <a href="http://en.wikipedia.org/wiki/">Wikipedia</a>.</em>

</template>
<!-- END: ACP STYLE #74766 -->

<!-- BEGIN: ACP STYLE #65727 -->
<template id="php_error_logs_page">

The following are all <a href="http://www.php.net/errorfunc">PHP errors</a> that have been collected for today. 
<br /><br />

<textarea class="input_field" cols="130" rows="25" readonly="readonly" wrap="off" style="width: 940px;">
<# ERROR_LIST #>
</textarea>

</template>
<!-- BEGIN: ACP STYLE #65727 -->

<!-- BEGIN: ACP STYLE #65468 -->
<template id="delete_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Confirm Album Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="admin.php?act=albums-d-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
                    
					<input type="hidden" value="<# USER_ID #>" name="user_id" />
					<input type="hidden" value="<# ALBUM2DELETE #>" name="album" />
                    
					<input type="submit" value="Yes" class="button1" />
					<input type="button" value="No" class="button1" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
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
<!-- END: ACP STYLE #65468 -->

<!-- BEGIN: ACP STYLE #94770 -->
<template id="rename_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Rename Album</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="admin.php?act=albums-r-d" method="post">
				<p>
					<b>New Album Title</b>:
					<br /><br />
                    
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" value="<# OLD_TITLE #>" onclick="$(this).val('');" />
					<br /><br />
                    
					<input type="hidden" value="<# ALBUM_ID #>" name="album" />
					<input type="hidden" value="<# USER_ID #>" name="user_id" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
                    
					<input type="submit" value="Rename Album" class="button1" />
					<input type="button" value="Cancel" class="button1" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
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
<!-- END: ACP STYLE #94770 -->

<!-- BEGIN: ACP STYLE #68107 -->
<template id="new_album_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>New Album</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="admin.php?act=albums-c-d" method="post">
				<p>
					<b>Album Title</b>:
					<br /><br />
                    
					<input type="text" name="album_title" maxlength="50" class="input_field" style="width: 250px;" />
					<br /><br />
                    
					<input type="hidden" value="<# USER_ID #>" name="user_id" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
                    
					<input type="submit" value="Create Album" class="button1" />
					<input type="button" value="Cancel" class="button1" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
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
<!-- END: ACP STYLE #68107 -->

<!-- BEGIN: ACP STYLE #27809 -->
<template id="move_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Move Images</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="admin.php?act=move_files-d" method="post">
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
                    
					<input type="hidden" value="<# USER_ID #>" name="user_id" />
					<input type="hidden" value="<# FILES2MOVE #>" name="files" />
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
                    
					<input type="submit" value="Move Images" class="button1" />
					<input type="button" value="Cancel" class="button1" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
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
<!-- END: ACP STYLE #27809 -->

<!-- BEGIN: APC STYLE #74322 -->
<template id="admin_gallery_page">

<div class="align_left_mfix">
    <ul class="jd_menu">
    
        <if="$mmhclass->info->user_owned_gallery == false">
            <li><a href="admin.php?act=user_list" class="button1">User Galleries</a>
     		<li><span onclick="gallery_action('delete');" title="Delete Selected" class="button1">Delete Images</span></li>
      		<li><span onclick="gallery_action('select');" title="Select/Deselect All" class="button1">Select All</span></li>
        <else>
     		<li><span onclick="gallery_action('delete');" title="Delete Selected" class="button1">Delete Images</span></li>
       	 	<li><span onclick="gallery_action('move', '<# GALLERY_ID #>');" title="Move Selected" class="button1">Move Images</span></li>
      		<li><span onclick="gallery_action('select');" title="Select/Deselect All" class="button1">Select All</span></li>
            
            <li><span class="button1">Album List</span>
                <ul class="menu_border">
                    <li class="header">Actions</li>
                    <li class="item"><a href="javascript:void(0);" onclick="toggle_lightbox('admin.php?act=albums-c&amp;id=<# GALLERY_ID #>', 'new_album_lightbox');">New Album</a></li>
                    <li class="header">Albums</li>
                    <li class="item"><a href="<# GALLERY_URL #>">Root Album</a> (<# TOTAL_ROOT_UPLOADS #> of <# TOTAL_UPLOADS #> images)</li>
                    <while id="album_pulldown_whileloop">
                        <li class="item"> 
                            <strong>&bull;</strong> <a href="<# GALLERY_URL #>&amp;cat=<# ALBUM_ID #>"><# ALBUM_NAME #></a> (<# TOTAL_UPLOADS #> images) 
                            ( <a href="javascript:void(0);" onclick="toggle_lightbox('admin.php?act=albums-d&amp;album=<# ALBUM_ID #>&amp;id=<# GALLERY_ID #>', 'delete_album_lightbox');">Delete</a> |
                            <a href="javascript:void(0);" onclick="toggle_lightbox('admin.php?act=albums-r&amp;album=<# ALBUM_ID #>&amp;id=<# GALLERY_ID #>', 'rename_album_lightbox');">Rename</a> )
                        </li>
                    </endwhile>
                </ul>
            </li>
    	</endif>
        
        <if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['search']) == true">
            <li><span class="button1">Search</span>
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
        	<li><a href="<# FULL_GALLERY_URL #>" class="button1">Clear Search</a></li>
        </endif>
        
    </ul>
</div>

<# PAGINATION_LINKS #>
<br /><br />

<if="$mmhclass->templ->templ_globals['empty_gallery'] == true">
	<# EMPTY_GALLERY #>
<else>
    <div class="table_border">
        <table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
            <tr>
	            <th colspan="4">
                
            		<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['search']) == true">
               			<# GALLERY_OWNER #>'s Gallery <# ALBUM_NAME #>
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
    </div>
    
    <div class="pagination_footer">
        <# PAGINATION_LINKS #>
    </div>
</endif>

</template>
<!-- END: ACP STYLE #74322 -->

<!-- BEGIN: ACP STYLE #71763 -->
<template id="delete_user_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Confirm Account Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="admin.php?act=users-d-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
                    
					<input type="hidden" value="<# USER2DELETE #>" name="id" />
                    
					<input type="submit" value="Yes" class="button1" />
					<input type="button" value="No" class="button1" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
                    <br /><br />
                    
					<div style="font-size: 10px; font-style: italic;">
                    	<strong>Note:</strong> Deleting an user will also delete any images that user has uploaded.
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
<!-- END: ACP STYLE #71763 -->

<!-- BEGIN: ACP STYLE #4842 -->
<template id="user_settings_page">

<form action="admin.php?act=users-s-s" method="post">
	<input type="hidden" name="user_id" value="<# USER_ID #>" />
    
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
			<tr>
				<th colspan="2">User Settings</th>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>User ID</span>:</td>
				<td class="tdrow2"><# USER_ID #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>Username</span>:</td>
				<td class="tdrow2"><# USERNAME #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;" valign="top"><span>Password</span>: <br /> <div class="explain">Please enter a password that is 6 to 30 characters in length. It is also recommended to randomize the password for enhanced security. To create a secure random password try the <a href="http://whatsmyip.org/passwordgen/" target="_blank">Password Generator</a>.</div></td>
				<td class="tdrow2" valign="top"><input type="password" style="width: 300px;" class="input_field" name="password" maxlength="30" value="*************" /></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;" valign="top"><span>IP Address</span>:</td>
				<td class="tdrow2">
                	<p title="<# IP_HOSTNAME #>" class="help"><# IP_ADDRESS #></p> ( <a href="http://whois.domaintools.com/<# IP_ADDRESS #>" target="_blank">Whois</a> | <a href="http://just-ping.com/index.php?vh=<# IP_ADDRESS #>" target="_blank">Ping</a> )
                    
                    <if="<# ACCOUNT_COUNT #> > 1">
     	               <br /><br />
                       
     	               There is a total of <strong><# ACCOUNT_COUNT #></strong> users registered under this IP address.
					</endif>
                </td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;" valign="top"><span>E-Mail Address</span>:</td>
				<td class="tdrow2" valign="top">
               	 	<input type="text" style="width: 300px;" name="email_address" class="input_field" value="<# EMAIL_ADDRESS #>" /> 
                	<br /><br />
                    
                	<a href="admin.php?act=mass_email&amp;id=<# USER_ID #>">Send E-Mail</a>
                </td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%"><span>Private Gallery</span>:</td>
				<td class="tdrow2" valign="top"><input type="radio" name="private_gallery" value="1" <# PRIVATE_GALLERY_YES #> /> Yes <input type="radio" name="private_gallery" value="0" <# PRIVATE_GALLERY_NO #> /> No</td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>Default Upload Layout</span>:</td>
				<td class="tdrow2"><input type="radio" name="upload_type" value="standard" <# STANDARD_UPLOAD_YES #> /> <p onclick="toggle_lightbox('index.php?layoutprev=std', 'upload_layout_preview_lightbox');" title="Click to preview" class="help">Standard</p> <input type="radio" name="upload_type" value="boxed" <# BOXED_UPLOAD_YES #> /> <p onclick="toggle_lightbox('index.php?layoutprev=bx', 'upload_layout_preview_lightbox');" title="Click to preview" class="help">Boxed</p></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>Date Registered</span>:</td>
				<td class="tdrow2"><# TIME_JOINED #></td>
			</tr>
			<tr>
				<td class="tdrow1" style="width: 38%;"><span>User Group</span>:</td>
				<td class="tdrow2">
                
					<if="$mmhclass->templ->templ_globals['is_root'] == true">
                    	User Group Not Allowed to be Changed (Protected User)
					<elseif="$mmhclass->info->user_data['user_group'] !== 'root_admin'">
                    	User Group Not Allowed to be Changed (Root Access Required)
                    <else>
						<select name="user_group" style="width: 300px;">
							<option value="1" <# NORMAL_USER_YES #>>Normal User</option>
							<option value="2" <# ADMIN_USER_YES #>>Administrator</option>
						</select>
                    </endif>
                    
                </td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2"><input type="submit" value="Save Settings" class="button1" /></td>
			</tr>
		</table>
	</div>
</form> 

</template>
<!-- END: ACP STYLE #4842 -->

<!-- BEGIN: ACP STYLE #5981 -->
<template id="user_list_page">

<# PAGINATION_LINKS #>
<br /><br />

<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<th>#</th>
			<th>Username</th>
			<th>E-Mail Address</th>
			<th>IP Address</th>
			<th>Date Registered</th>
			<th>Gallery Status</th>
			<th>Total Uploads</th>
			<th>Unpayed Balance</th>
			<th>Payed Balance</th>
			<th>Total Bots Recieved</th>
			<th>Actions</th>
		</tr>
        
		<while id="user_list_whileloop">
			<tr>				
				<td class="<# TDCLASS #>"><# USER_ID #></td>			
				<td class="<# TDCLASS #>"><a href="admin.php?gal=<# USER_ID #>"><# USERNAME #></a></td>
				<td class="<# TDCLASS #>"><a href="admin.php?act=mass_email&amp;id=<# USER_ID #>"><# EMAIL_ADDRESS #></a></td>
				<td class="<# TDCLASS #>"><p title="<# IP_HOSTNAME #>" class="help"><# IP_ADDRESS #></p> (<a href="http://whois.domaintools.com/<# IP_ADDRESS #>" target="_blank">Whois</a>)</td>
				<td class="<# TDCLASS #>"><# TIME_JOINED #></td>
				<td class="<# TDCLASS #>"><# GALLERY_STATUS #></td>
				<td class="<# TDCLASS #>"><# TOTAL_UPLOADS #></td>
				<td class="<# TDCLASS #>"><# BALANCE #></td>
				<td class="<# TDCLASS #>"><# PAYED #></td>
				<td class="<# TDCLASS #>"><# TOTAL #></td>
				<td class="<# TDCLASS #>"><a href="javascript:void(0);" onclick="toggle_lightbox('admin.php?act=users-d&amp;id=<# USER_ID #>', 'delete_user_lightbox');">Delete</a> | <a href="admin.php?act=users-s&amp;id=<# USER_ID #>">Settings</a></td>
			</tr>
		</endwhile>
        
		<tr>
			<td colspan="8" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- END: ACP STYLE #5981 -->

<!-- BEGIN: ACP STYLE: #55553 -->
<template id="mass_email_preview">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Bulk E-Mail Preview</th>
	</tr>
	<tr>
		<td class="tdrow1">
			<pre><# EMAIL_MESSAGE #></pre>
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: ACP STYLE #55553 -->

<!-- BEGIN: ACP STYLE #95279 -->
<template id="mass_email_page">

<form action="admin.php?act=mass_email-s" method="post">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
			<tr>
				<th colspan="2">Bulk E-Mail</th>
			</tr>
			<tr>
				<td style="width: 27%;" class="tdrow1" valign="top"><span>Send To:</span></td> 
				<td class="tdrow2">
                	<select name="sendto_who" style="width: 300px;" onchange="$('div[id=sendto_user]').attr('style', ('display: ' + (($(this).val()==2) ? 'inline' : 'none')));">
                    	<option value="1">All Users</option>
                        <option value="2">Specific User</option>
                        <option value="3">Only Normal Users</option>
                        <option value="4">Only Site Administrators</option>
                    </select>
                    
                    <div id="sendto_user" style="display: none;">
                    	<br /><br /> User:
                        <select name="sendto_user" style="width: 270px;">
                        	<while id="userlist_whileloop">
                            	<option value="<# USER_ID #>"><# USERNAME #> (<# EMAIL_ADDRESS #>)</option>
                            </endwhile>
                        </select>
                	</div>
                    
                	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['id']) == false">
                    	<script type="text/javascript">
							$("div[id=sendto_user]").attr("style", "display: inline;");
							$("select[name=sendto_who] option[value=2]").attr("selected", "selected");
							$("select[name=sendto_user] option[value=<# SPECIFIC_USER #>]").attr("selected", "selected");
						</script>
                    </endif>
                </td>
			</tr>
			<tr>
				<td style="width: 27%;" class="tdrow1"><span>E-Mail Subject:</span></td> 
				<td valign="top" class="tdrow2"><input type="text" name="email_subject" style="width: 300px;" class="input_field" /></td>
			</tr>
			<tr>
				<td style="width: 27%;" class="tdrow1" valign="top"><span>Message:</span> <br /> <div class="explain">Please do not use HTML because this message will be sent in a plain text format. If any HTML is found, then it will automatically be removed.</div></td> 
				<td class="tdrow2"><textarea rows="25" cols="80" class="input_field" name="message_body"></textarea></td>
			</tr>
			<tr>
				<td style="width: 27%;" class="tdrow1" valign="top"><span>Security Code:</span></td> 
				<td valign="top" class="tdrow2"><# CAPTCHA_CODE #></td>
			</tr>
			<tr>
				<td class="table_footer" colspan="2">
                	<input type="button" class="button1" value="Preview Message" onclick="if($('textarea[name=message_body]').val()==''){alert('No message to preview.');}else{toggle_lightbox(('admin.php?act=mass_email-p&amp;post=' + base64_encode($('textarea[name=message_body]').val())), 'mass_email_preview_lightbox');}" />
               		<input type="submit" class="button1" value="Send Message" />
                </td>
			</tr>
		</table>
	</div>
</form>

</template>
<!-- END: ACP STYLE #95279 -->

<!-- BEGIN: ACP STYLE #90107 -->
<template id="ban_control_page">

<script type="text/javascript">
	function validate_ip(info)
	{
		if (info.checked == true) {
			var current_ip = $("input[name=do_ban[ip_address]]").val();
			
			if (current_ip.match(/([\*])/g) !== null) {
				info.checked = false;
				alert("This function is not available in wildcard matches.");
			}	
		}
	}
</script>

<form action="admin.php?act=ban_control-u" method="post">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
			<tr>
				<th colspan="2">Manage Banned Users</th>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Ban Username:</span></td>
				<td class="tdrow2">
                	<input type="text" name="do_ban[username]" class="input_field" style="width: 300px;" />
                    <br /><br />
                    
                    <input type="checkbox" name="delete_files[username]" value="1" /> Delete <b>ALL</b> images uploaded by this user?
                </td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Unban Username:</span></td> 
				<td class="tdrow2" valign="top">
					<select multiple="multiple" name="unban[username][]" style="width: 300px; height: 150px;" class="input_field">
                    
                        <while id="banned_user_whileloop">
                            <option value="<# BAN_ID #>" title="<# USERNAME #>"><# USERNAME #></option>
                        </endwhile>
				
                	</select>
				</td>
			</tr>
			<tr>
				<th colspan="2">Manage Banned IP Addresses</th>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Ban IP Address:</span> <br /> <div class="explain">Wildcard matching in the last two sections of an IP address is supported using the <b>*</b> character.<br /><br />Examples: 123.456.*.*, 123.456.*.789, or 123.456.789.*</td> 
				<td class="tdrow2" valign="top">
                	<input type="text" name="do_ban[ip_address]" class="input_field" style="width: 300px;" />
                    <br /><br />
                    
                    <input type="checkbox" name="delete_files[ip_address]" value="1" onclick="validate_ip(this);" /> Delete <b>ALL</b> images uploaded by this IP address?<br />
                    <input type="checkbox" name="delete_users[ip_address]" value="1" onclick="validate_ip(this);" /> Delete <b>ALL</b> user accounts created under this IP address?
                </td>
			</tr>
			<tr>
				<td style="width: 30%;" class="tdrow1" valign="top"><span>Unban IP Address: </span></td> 
				<td class="tdrow2" valign="top">
					<select multiple="multiple" name="unban[ip_address][]" style="width: 300px; height: 150px;" class="input_field">
                       
                        <while id="banned_ip_address_whileloop">
                            <option value="<# BAN_ID #>" title="<# IP_ADDRESS #>"><# IP_ADDRESS #></option>
                        </endwhile>
					
                    </select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="table_footer"><input type="submit" value="Update Ban Filter" class="button1" /></td>
			</tr>
		</table>
	</div>
</form>

</template>
<!-- END: ACP STYLE #90107 -->

<!-- BEGIN: ACP STYLE #34683 -->
<template id="delete_files_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Confirm Image Deletion</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
			<br />
			<form action="admin.php?act=delete_files-d" method="post">
				<p>
					Are you sure you wish to carry out this operation? 
					<br /><br />
					If you select "Yes" there is no undo.
					<br /><br />
                    
					<input type="hidden" value="<# RETURN_URL #>" name="return" />
					<input type="hidden" value="<# FILES2DELETE #>" name="files" />
					
                    <input type="submit" value="Yes" class="button1" />
					<input type="button" value="No" class="button1" onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');" />
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
<!-- BEGIN: ACP STYLE #34683 -->

<!-- BEGIN: ACP STYLE #28777 -->
<template id="file_logs_page">

<div class="align_left_mfix">
    <ul class="jd_menu">
    	<li><span class="button1">Search</span>
            <ul class="menu_border">
                <li class="header">Search Logs</li>
                <li class="item text_align_center">
                    <input type="text" id="file_search" class="input_field" maxlength="25" style="width: 130px;" value="Enter Filename" onclick="$(this).val('');" onkeydown="if(event.keyCode==13){$('input[id=file_search_button]').click();}" />
                    <input type="button" value="Go" id="file_search_button" onclick="location.href=('admin.php?act=file_logs<# ORDERBY_URL_QUERY #>&amp;search=' + encodeURIComponent($('input[id=file_search]').val()));" />
                    <br /><br />
                    <b>%</b> and <b>_</b> are <a href="http://dev.mysql.com/doc/refman/5.0/en/string-comparison-functions.html#operator_like" target="_blank">wildcard characters</a>.
                </li>
            </ul>
    	</li>
        
    	<li><span class="button1">Order By</span>
            <ul class="menu_border">
                <li class="header">Order By What?</li>
                <li class="item text_align_center">
                    <select id="orderby_field" style="width: 130px;">
                    	<option value="log_id">Log ID (Default)</option>
                        <option value="filename">Filename</option>
                        <option value="filesize">Filesize</option>
                        <option value="ip_address">IP Address</option>
                        <option value="time_uploaded">Date Uploaded</option>
                        <option value="gallery_id">User</option>
                    </select>
                    
                    <select id="orderby_sort" style="width: 95px;">
                        <option value="DESC">Descending</option>
                        <option value="ASC">Ascending</option>
                    </select>
                    
                    <input type="button" value="Go" onclick="location.href=('admin.php?act=file_logs<# FILENAME_SEARCH_QUERY #>&amp;orderby=' + encodeURIComponent($('select[id=orderby_field] option:selected').val()) + '&amp;sort=' + encodeURIComponent($('select[id=orderby_sort] option:selected').val()));" />
                </li>
            </ul>
    	</li>
        
        <li><a href="admin.php?act=file_logs-el" class="button1" onclick="if(confirm('There is no undo. Continue?')==false){return false;}">Purge Logs</a></li>
    </ul>
</div>

<# PAGINATION_LINKS #>
<br /><br />

<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<th>#</th>
			<th>Filename</th>
			<th>Status</th>
            <th>Upload Type</th>
			<th>Filesize</th>
			<th>IP Address</th>
			<th>Date Uploaded</th>
			<th>Uploaded By</th>
		</tr>
        
		<while id="file_logs_whileloop">
			<tr>				
				<td class="<# TDCLASS #>"><# LOG_ID #></td>			
                
                <if="$mmhclass->templ->templ_globals['file_exists'] == true">
					<td class="<# TDCLASS #>"><a href="viewer.php?file=<# FILENAME #>"><# FILENAME #></a> (<a href="javascript:void(0);" onclick="toggle_lightbox(('admin.php?act=delete_files&amp;files=' + encodeURIComponent('<# FILENAME #>')), 'delete_files_lightbox');">Delete</a>)</td>
				<else>
                	<td class="<# TDCLASS #>"><# FILENAME #></td>
                </endif>
                
                <td class="<# TDCLASS #>"><# FILE_STATUS #></td>
                <td class="<# TDCLASS #>"><# UPLOAD_TYPE #></td>
				<td class="<# TDCLASS #>"><# FILESIZE #></td>
				<td class="<# TDCLASS #>"><p title="<# IP_HOSTNAME #>" class="help"><# IP_ADDRESS #></p> (<a href="http://whois.domaintools.com/<# IP_ADDRESS #>" target="_blank">Whois</a>)</td>
				<td class="<# TDCLASS #>"><# TIME_UPLOADED #></td>
				<td class="<# TDCLASS #>"><# UPLOADED_BY #></td>
			</tr>
		</endwhile>
        
		<tr>
			<td colspan="8" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- END: ACP STYLE #28777 -->

<!-- BEGIN: ACP STYLE #89191 -->
<template id="process_list_page">

<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<th>Processes</th>
		</tr>
		<tr>				
			<td class="tdrow1"><pre><# PROCESSES #></pre></td>		
		</tr>
		<tr>
			<td class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- END: ACP STYLE #89191 -->

<!-- BEGIN: ACP STYLE #62177 -->
<template id="language_settings_page">

<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<th>#</th>
			<th>Filename</th>
            <th>Last Modification</th>
            <th>Full Path</th>
		</tr>
        
		<while id="language_file_whileloop">
			<tr>				
				<td class="<# TDCLASS #>"><# FILE_ID #></td>			
				<td class="<# TDCLASS #>"><a href="admin.php?act=language_settings-e&amp;file=<# FILE_ID #>"><# FILENAME #></a></td>
				<td class="<# TDCLASS #>"><# LAST_MODIFICATION #></td>
				<td class="<# TDCLASS #>"><# REAL_PATH #></td>
			</tr>
		</endwhile>
        
		<tr>
			<td colspan="4" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- END: ACP STYLE #62177 -->

<!-- BEGIN: ACP STYLE #29029 -->
<template id="edit_language_page">

<script type="text/javascript">
	function new_language_setting()
	{
		var setting_id = Math.ceil(Math.random() * 999);
		
		var new_setting = 
			" <div id=\"new_setting_" + setting_id + "\"><hr />																													" + 
			"		<textarea cols=\"130\" rows=\"5\" name=\"newlang[text][]\" class=\"input_field\" style=\"width: 925px;\"></textarea> <br />									" + 
			"		Setting #<input type=\"text\" name=\"newlang[id][]\" maxlength=\"4\" class=\"input_field\" style=\"width: 100px;\" value=\"" + setting_id + "\" /> &bull; 	" + 
			"		Setting Type: 																																		   		" + 
			"		<select name=\"newlang[type][]\" style=\"width: 95px; vertical-align: middle;\">																			" + 
			"			<option value=\"string\">String</option>																												" + 
			"			<option value=\"array\">Array</option>																													" + 
			"			<option value=\"NULL\">NULL</option> 																													" + 
			"		</select> &bull; 																																			" + 
			"		Setting Descrption: <input type=\"text\" name=\"newlang[desc][]\" class=\"input_field\" style=\"width: 420px;\" value=\"\" /> 						    	" + 
			"		<a href=\"javascript:void(0);\" onclick=\"$('div[id=new_setting_" + setting_id + "]').remove();\">Remove</a>												" +
			" </div> 																																							"; 
			
		$("#new_language_settings").append(new_setting);
	}
	
	function restore_languages(id)
	{
		window.location = ("admin.php?act=language_settings-rd&file_id=" + id);
	}
</script>

<form action="admin.php?act=language_settings-e-s" method="post">
    <div class="align_left_mfix">
        <span onclick="new_language_setting();" class="button1">New Setting</span>
        <span onclick="if(confirm('There is no undo. Continue?')==true){restore_languages('<# LANGUAGE_FILENAME_ID #>')}" class="button1">Restore Default Values</span>
        <span style="vertical-align: middle;"><input type="checkbox" name="set_default" value="1" /> Save this as default file too.</span>
    </div>
    
    <div class="align_right_mfix">
        <a href="admin.php?act=language_settings" class="button1">Language Settings</a>
    </div>
    <br /><br />
    
	<input type="hidden" name="file_id" value="<# LANGUAGE_FILENAME_ID #>" />
    
    <div class="table_border">
        <table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
            <tr>
                <th colspan="2">Language Settings for <# LANGUAGE_FILENAME #></th>
            </tr>
            <tr>
                <td class="tdrow1" colspan="2">
                	<div class="text_align_center">
                    	This file contains some language settings that are a part of ImgPizza but were not able to 
                    	be placed into template files. In each setting, %s represents a place holder for a value that will 
                    	be dynamically generated by ImgPizza; so be careful while editing to not remove them.
                    </div>
                    
                    <div id="new_language_settings"></div> 
                </td>
            </tr>
            
            <while id="edit_language_whileloop">
                <tr>
                    <td style="width: 38%;" class="tdrow1" valign="top"><span>Language Setting #<# LANGUAGE_INDEX #>:</span> <br /> <div class="explain">Description: "<# LANGUAGE_DETAILS #>."</div></td> 
                    <td class="tdrow2" valign="top">
                        <textarea name="language[text][<# LANGUAGE_INDEX #>]" class="input_field" style="width: 750px;" cols="100" rows="5"><# LANGUAGE_CONTENT #></textarea>
                        <input type="hidden" name="language[desc][<# LANGUAGE_INDEX #>]" value="<# LANGUAGE_DETAILS #>" />
                        <input type="hidden" name="language[type][<# LANGUAGE_INDEX #>]" value="<# LANGUAGE_TYPE #>" />
                    </td>
                </tr>
            </endwhile>
            
            <tr>
                <td colspan="2" class="table_footer"><input type="submit" class="button1" value="Save Settings" /></td>
            </tr>
        </table>
    </div>
</form>

</template>
<!-- END: ACP STYLE #29029 -->

<!-- BEGIN: ACP STYLE #83901 -->
<template id="robot_logs_page">

<div class="align_left_mfix">
	<a href="admin.php?act=robot_logs-de" onclick="if(confirm('There is no undo. Continue?')==false){return false;}" class="button1">Purge Logs</a>
</div>

<# PAGINATION_LINKS #>
<br /><br />

<div class="table_border">
	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<th>ID</th>
			<th>Robot Name</th>
			<th>Date Indexed</th>
			<th>Page Indexed</th>
			<th>Referring Page</th>
		</tr>
        
		<while id="robot_logs_whileloop">
			<tr>				
				<td class="<# TDCLASS #>"><# LOG_ID #></td>			
				<td class="<# TDCLASS #>"><# ROBOT_NAME #></td>
				<td class="<# TDCLASS #>"><# DATE_INDEXED #></td>
				<td class="<# TDCLASS #>"><a href="<# PAGE_INDEXED #>" title="<# PAGE_INDEXED #>"><# PAGE_INDEXED_TEXT #></a></td>
				<td class="<# TDCLASS #>"><# HTTP_REFERER #></td>
			</tr>
		</endwhile>
        
		<tr>
			<td colspan="5" class="table_footer">&nbsp;</td>
		</tr>
	</table>
</div>

</template>
<!-- END: ACP STYLE #83901 -->

<!-- BEGIN: ACP STYLE #72341 -->
<template id="site_settings_page">

<div class="align_left_mfix">
	<a href="admin.php?act=language_settings" class="button1">Language Settings</a>
	<span onclick="$('tr[class=misc_settings]').toggle(); if($('tr[class=misc_settings]:visible').length > 1){scroll($(document).width(), $(document).height());}" class="button1">Miscellaneous Settings</span>
	<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=7572182" class="button1" title="Help keep ImgPizza alive."><strong>Donate</strong></a>
</div>

<div class="align_right_mfix">
    <ul class="jd_menu">
     	<li><span class="button1">Advanced Debugging Tools</span>
         	<ul class="menu_border">
            	<li class="header">Tools</li>
                <li class="item"><a href="admin.php?act=errlogs">PHP Error Logs</a></li>
                <li class="item"><a href="admin.php?act=phpinfo">PHP Information</a></li>
                <li class="item"><a href="admin.php?act=processes">Running Processes</a></li>
                <li class="item"><a href="admin.php?act=sysinfo">System Information</a></li>
            </ul>
		</li>
    </ul>
</div>
<br /><br />

<form action="admin.php?act=site_settings-s" method="post">
	<div class="table_border">
		<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
			<tr>
				<th colspan="2">Site Settings</th>
			</tr>
            
            <if="$mmhclass->templ->templ_globals['new_version'] == true">
                <tr>
                    <td colspan="2" class="new_version_box">
                        A new version of ImgPizza has become available.<br />
                        <a href="<# VERSIONCHECK_ANNOUNCEMENT #>">View Announcement</a> - <a href="<# VERSIONCHECK_DOWNLOAD #>">Download Package</a><br />
                        Version: <# VERSIONCHECK_VERSION #> - Posted On: <# VERSIONCHECK_PUBDATE #>
                    </td>
                </tr>
            </endif>
            
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Website Name:</span></td> 
				<td class="tdrow2"><input type="text" style="width: 300px;" class="input_field" name="site_name" value="<# SITE_NAME #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Allowed File Extensions:</span> <br /> <div class="explain">File extensions that are allowed to be uploaded by Guests. Separate each with a comma, but do not use dots, 'and', or spaces.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="file_extensions" value="<# FILE_EXTENSIONS #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Allowed File Extensions (Users):</span> <br /> <div class="explain">File extensions that are allowed to be uploaded by registered users. Separate each with a comma, but do not use dots, 'and', or spaces.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="user_file_extensions" value="<# USER_FILE_EXTENSIONS #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Max Filesize:</span> <br /> <div class="explain">The maximum allowed filesize per file for Guests. There are 1,048,576 bytes for every one megabyte. <a href="http://www.t1shopper.com/tools/calculate/">Conversion Calculator</a>.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="max_filesize" value="<# MAX_FILESIZE #>" /> Bytes</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Max Filesize (Users):</span> <br /> <div class="explain">The maximum allowed filesize per file for registered users. There are 1,048,576 bytes for every one megabyte. <a href="http://www.t1shopper.com/tools/calculate/">Conversion Calculator</a>.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="user_max_filesize" value="<# USER_MAX_FILESIZE #>" /> Bytes</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Incoming E-Mail Address:</span> <br /> <div class="explain">This is the E-Mail Address that all incoming mail is addressed to.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="email_in" value="<# EMAIL_IN #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Outgoing E-Mail Address:</span> <br /> <div class="explain">This is the E-Mail Address that all mail appears to come from.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" class="input_field" style="width: 300px;" name="email_out" value="<# EMAIL_OUT #>" /></td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Public Gallery Viewing:</span> <br /> <div class="explain">Set this setting to 'No' to disable the ability of anyone except site administrators from viewing the "Public Gallery" of this website.</div></td> 
				<td class="tdrow2" valign="top"><input type="radio" value="1" name="gallery_viewing" <# GALLERY_VIEWING_YES #> /> Yes <input type="radio" value="0" name="gallery_viewing" <# GALLERY_VIEWING_NO #> /> No</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1" valign="top"><span>Max Results:</span> <br /> <div class="explain">Maximum number of whatever to display on a single page. This setting also determines how many URLs can be uploaded at once.</div></td> 
				<td class="tdrow2" valign="top">
					<select name="max_results" style="width: 300px;">
						<while id="max_results_forloop">
							<option value="<# MAX_RESULTS_SUM #>" <# MAX_RESULTS_SELECTED #>><# MAX_RESULTS_SUM #></option>
						</endwhile>
					</select>
				</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Thumbnail Height:</span> <br /> <div class="explain">Maximum height of a generated thumbnail.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="thumbnail_height" value="<# THUMBNAIL_HEIGHT #>" /> Pixels</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Thumbnail Width:</span> <br /> <div class="explain">Maximum width of a generated thumbnail.</div></td> 
				<td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="thumbnail_width" value="<# THUMBNAIL_WIDTH #>" /> Pixels</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Thumbnail Format:</span> <br /> <div class="explain">This setting can have a big effect on bandwidth usage. Only thumbnails created after a change to this setting will be affected by the change.</div></td> 
				<td class="tdrow2" valign="top">
					<select name="thumbnail_type" style="width: 300px;">
						<option value="png" <# THUMBNAIL_TYPE_PNG #>>High Quality PNG (Uncompressed)</option>
                        <option value="jpeg" <# THUMBNAIL_TYPE_JPEG #>>Low Quality JPEG (Compressed)</option>
					</select>
                </td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Advanced Thumbnails:</span> <br /> <div class="explain">For an example of an advanced thumbnail click <a href="css/images/adv_thumb_ex.png">here</a>. Only thumbnails created after a change to this setting will be affected by the change.</div></td> 
				<td class="tdrow2" valign="top">
					<if="$mmhclass->image->manipulator == 'imagick'">
						<input type="radio" value="1" name="advanced_thumbnails" <# ADVANCED_THUMBNAILS_YES #> /> Yes <input type="radio" value="0" name="advanced_thumbnails" <# ADVANCED_THUMBNAILS_NO #> /> No
					 <else>
						<em>The <a href="http://php.net/imagick">Imagick Image Library</a> is Not Found</em>
					</endif>
				</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Disable Uploading:</span> <br /> <div class="explain">Disable uploading for everyone except site administrators.</div></td> 
				<td class="tdrow2" valign="top"><input type="radio" value="1" name="uploading_disabled" <# UPLOADING_DISABLED_YES #> /> Yes <input type="radio" value="0" name="uploading_disabled" <# UPLOADING_DISABLED_NO #> /> No</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Disable Guest Uploading:</span> <br /> <div class="explain">Disable uploading for everyone except registered users.</div></td> 
				<td class="tdrow2" valign="top"><input type="radio" value="1" name="useronly_uploading" <# USERONLY_UPLOADING_YES #> /> Yes <input type="radio" value="0" name="useronly_uploading" <# USERONLY_UPLOADING_NO #> /> No</td>
			</tr>
			<tr>
				<td style="width: 38%;" class="tdrow1"><span>Disable User Registration:</span></td> 
				<td class="tdrow2" valign="top"><input type="radio" value="1" name="registration_disabled" <# REGISTRATION_DISABLED_YES #> /> Yes <input type="radio" value="0" name="registration_disabled" <# REGISTRATION_DISABLED_NO #> /> No</td>
			</tr>
            
            <tr style="display: none;" class="misc_settings">
                <td style="width: 38%;" class="tdrow1"><span>Date Format:</span> <br /> <div class="explain">For information on how to setup the date format visit <a href="http://www.php.net/date" target="_blank">php.net.</a><br />Preview of Current Format: <# CURRENT_TIME #></div></td> 
                <td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="date_format" value="<# DATE_FORMAT #>" /></td>
            </tr>
            <tr style="display: none;" class="misc_settings">
                <td style="width: 38%;" class="tdrow1"><span>Google Analytics (optional):</span> <br /> <div class="explain">Profile ID for the <a href="http://www.google.com/analytics">Google Analytics</a> tracking service.</div></td> 
                <td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="google_analytics" value="<# GOOGLE_ANALYTICS #>" /></td>
            </tr>
            <tr style="display: none;" class="misc_settings">
                <td style="width: 38%;" class="tdrow1"><span>reCAPTCHA Public Key:</span> <br /> <div class="explain">Public API Key for the popular spam prevention service, <a href="http://recaptcha.net/">reCAPTCHA</a>.</div></td> 
                <td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="recaptcha_public" value="<# RECAPTCHA_PUBLIC #>" /></td>
            </tr>
            <tr style="display: none;" class="misc_settings">
                <td style="width: 38%;" class="tdrow1"><span>reCAPTCHA Private Key:</span> <br /> <div class="explain">Private API Key for the popular spam prevention service, <a href="http://recaptcha.net/">reCAPTCHA</a>.</div></td> 
                <td class="tdrow2" valign="top"><input type="text" style="width: 300px;" class="input_field" name="recaptcha_private" value="<# RECAPTCHA_PRIVATE #>" /></td>
            </tr>
            
			<tr>
				<td class="table_footer" colspan="2"><input type="submit" class="button1" value="Save Settings" /></td>
			</tr>
		</table>
	</div>
</form>

</template>
<!-- END: ACP STYLE #72341 -->