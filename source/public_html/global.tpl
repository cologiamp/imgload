<!-- BEGIN: GLOBAL GALLERY CELL -->
<template id="global_gallery_layout">

<# TABLE_BREAK #>
<td class="<# TDCLASS #> text_align_center" valign="top">
	<if="$mmhclass->templ->templ_globals['file_options'] == true">
	

    	<input type="checkbox" name="userfile" value="<# FILENAME #>" link2="[URL=<# SITEINFO_BASENAME #>/viewer.php?file=<# FILENAME #>][IMG]<# SITEINFO_BASENAME #>/images/<# FILENAME_THUMB #>[/IMG][/URL]" link3="&lt;a href=&quot;<# SITEINFO_BASENAME #>/viewer.php?file=<# FILENAME #>&quot;&gt;&lt;img src=&quot;<# SITEINFO_BASENAME #>/images/<# FILENAME_THUMB #>&quot; border=&quot;0&quot; alt=&quot;<# FILENAME #>&quot; /&gt;&lt;/a&gt;" link1="<# SITEINFO_BASENAME #>/viewer.php?file=<# FILENAME #>" />
		<input type="text" id="<# FILE_ID #>_title_rename" maxlength="25" style="width: 165px; display: none;" class="input_field" onblur="gallery_action('rename-d', '<# FILENAME #>', '<# FILE_ID #>');" onkeydown="if(event.keyCode==13){gallery_action('rename-d', '<# FILENAME #>', '<# FILE_ID #>');}" />
		<span class="arial" title="Click to change title" id="<# FILE_ID #>_title" onclick="gallery_action('rename', this.id);" class="font-weight: 700;"><# FILE_TITLE #></span>
	
	    <br /><br />
	<a href="viewer.php?file=<# FILENAME #>"><img src="<# SITEINFO_BASENAME #>/images/<# FILENAME_THUMB #>" alt="<# FILENAME #>" /></a>
	<br /><br />
	<a href="download.php?file=<# FILENAME #>"><b>Download Image</b></a> | <# CONTENT #> | <b>Views: <# VIEWER_UNIQUE_CLICKS #> </b>
	
	<else>
	<!--
		<a href="viewer.php?file=<# FILENAME #>" title="<# FILENAME #>"><strong><# FILE_TITLE #></strong></a>
	-->
	<tr>
		<td style="width: 20%;" valign="middle" class="text_align_center">
			<a href="<# BASE_URL #>viewer.php?file=<# FILENAME #>"><img src="index.php?module=thumbnail&amp;file=<# FILENAME #>" alt="<# FILENAME #>" <# THUMBNAIL_SIZE #> </a>
		</td>
        
		<td style="width: 80%;">
			<table cellspacing="1" cellpadding="0" border="0" style="width: 100%;">
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="highlight(this);" type="text" style="width: 605px;" value="<# BASE_URL #>viewer.php?file=<# FILENAME #>" /></td>
					<td>Direct Link</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="highlight(this);" type="text" style="width: 605px;" value="&lt;a href=&quot;<# BASE_URL #>viewer.php?file=<# FILENAME #>&quot;&gt;&lt;img src=&quot;<# BASE_URL #>images/<# FILENAME_THUMB #>&quot; border=&quot;0&quot; alt=&quot;<# FILENAME #>&quot; /&gt;&lt;/a&gt;" /></td>
					<td>Thumbnail for Website</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="highlight(this);" type="text" style="width: 605px;" value="[URL=<# BASE_URL #>viewer.php?file=<# FILENAME #>][IMG]<# BASE_URL #>images/<# FILENAME_THUMB #>[/IMG][/URL]" /></td>
					<td>Thumbnail for Forum</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="highlight(this);" type="text" style="width: 605px;" value="[URL=<# BASE_URL #>viewer.php?file=<# FILENAME #>]<# FILENAME #>[/URL]" /></td>
					<td>Direct link for Forum</td>
				</tr>
				<tr>
					<td><input readonly="readonly" class="input_field" onclick="highlight(this);" type="text" style="width: 605px;" value="Thanks to <# SITE_NAME #> for &lt;a href=&quot;<# BASE_URL #>&quot;&gt;free image hosting&lt;/a&gt;" /></td>
					<td>Link to Us</td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	</endif>
	
<!-- 
-->
	
	</td>

</template>
<!-- END: GLOBAL GALLERY CELL -->

<!-- BEGIN: GLOBAL MESSAGE BOX -->
<template id="global_message_box">
	
<div class="message_box">
	<# MESSAGE #>
</div>

</template>
<!-- END: GLOBAL MESSAGE BOX -->

<!-- BEGIN: GLOBAL WARNING BOX -->
<template id="global_warning_box">

<div class="message_box">
	<h1>General Notice</h1><br />
	<# ERROR #>
</div>

</template>
<!-- END: GLOBAL WARNING BOX -->

<!-- BEGIN: GLOBAL LIGHTBOX WARNING BOX -->
<template id="global_lightbox_warning">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>&nbsp;</th>
	</tr>
	<tr>
		<td class="message_box">
        	<h1>General Notice</h1><br />
          	<# ERROR #>
		</td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="$('div[class=lightbox_main]').parent().remove();">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: GLOBAL LIGHTBOX WARNING BOX -->