<!-- BEGIN: NORMAL UPLOAD PAGE -->
<template id="normal_upload_page">

<script type="text/javascript" src="js/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
	var swfu;

	window.onload = function() {
		var settings = {
			flash_url : "js/swfupload.swf",
			upload_url: "fupload.php",
			//post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
			file_size_limit : "30 MB",
			file_types : "*.jpg\;*.jpeg\;*.gif\;*.png\;",
			file_types_description : "*.jpg\;*.jpeg\;*.gif\;*.png\;",
			file_upload_limit : 100,
			file_queue_limit : 0,
			custom_settings : {
				progressTarget : "fsUploadProgress",
				cancelButtonId : "btnCancel"
			},
			debug: false,

			// Button settings
			button_image_url: "./css/images/button-cloudfull.png",
			button_width: "321",
			button_height: "157",
			button_placeholder_id: "spanButtonPlaceHolder",
			button_text: '<span class="theFont"> </span>',
			button_text_style: ".theFont { background-color: #f00;text-align:center;font-family:'Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;color:#333;font-size:12px;font-weight:bold;text-shadow:0 1px 0 #FFFFFF; cursor: pointer; }",
			button_text_left_padding: 12,
			button_text_top_padding: 50,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			queue_complete_handler : queueComplete,	// Queue plugin event
			post_params : {
				thumbsize: 180,
				PHPSESSID: "<?php echo session_id();?>"
			}
		};

		swfu = new SWFUpload(settings);
		
		$("#upload_form select.thumbsize").change(function() {
			var post_params = swfu.settings.post_params;
			post_params.thumbsize = $(this).val();
			swfu.setPostParams(post_params);
		});
     };
</script>
<div id="content" class="container-fluid">
<div class="container">
<div class="row" id="main">
<div class="col-xs-12 canvas-holder">
</div>
<div class="col-xs-12">
<div class="text1">
Upload your <div class="word">Images</div><span class="typed-cursor">|</span>
</div>
<div class="text2" id="browsetext">
Images up to 30 Mb
</div>

<form action="fupload.php" method="post" id="upload_form" enctype="multipart/form-data">
	
	<div class="grey">

		<div style="margin-left: auto; margin-right: auto;" class="fieldset flash" id="fsUploadProgress">

		<div id="spanButtonPlaceHolder"></div>
		<br>
        	
        </div>
        <div id="divStatus">0 Files Uploaded</div>
        	<div>
                	
			<input name="adult" value="1" type="hidden" />
            </div>
        <br />	
    	Thumbnail Size: 
		<select name="thumbsize" id="thumbsize" class="thumbsize">
			<option value="100">100x100(tiny)</option>
			<option value="160">160x160</option>
			<option value="180" selected="selected">180x180(standard)</option>
			<option value="220">220x220(large)</option>
			<option value="250">250x250(extra large)</option>
		</select>
	
	</div>

        <br />
	<div style="padding-top: 5px;"><input name="tos" checked="checked" type="checkbox" /> I have read and agreed to the <a target="_blank" href="/tos"> Terms of Service</a>. <br /><br /></div>
                        <input class="button1" id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
</form>

</div>

</div>
</div>
</div>

</template>
<!-- END: NORMAL UPLOAD PAGE -->

<!-- BEGIN: URL UPLOAD PAGE -->
<template id="url_upload_page">
<center>



	
	
<script type="text/javascript">
	function set_upload_type(id)
	{
		$("div[id=upload_types] div:visible").attr("style", "display: none;"); 
		$("div[id=" + $(id).val() + "]").attr("style", "display: block;");	
		
		switch ($(id).val()) {
			case "paste_upload":
				$("input[id=more_files_button]").attr("disabled", "disabled");
				$("span[id=more_instructions]").html("<br />Separate each image URL with a new line.");
				$("span[id=instructions]").html("Enter up to 40 image file URLs to upload");
				break;
			case "normal_upload":
				$("span[id=more_instructions]").html("&nbsp;");
				$("input[id=more_files_button]").removeAttr("disabled");
				$("span[id=instructions]").html("Enter an image file URL to upload");
				break;
			case "webpage_upload":
				$("input[id=more_files_button]").attr("disabled", "disabled");
				$("span[id=instructions]").html("Enter a website URL to extract images from");
				$("span[id=more_instructions]").html("<br />Only the first 40 images that are found will be uploaded.");
				break;
		}
	}
</script>

<br/>

<br/>

Remote | <a href="./flash">Flash</a> | <a href="./">Local</a>
<br/>





<form action="upload.php" method="post" id="upload_form" enctype="multipart/form-data">
<div class="grey">
<br />
	<p>
		<b>Images up to 30 Megabytes</b>
		<br>
		
		<div id="upload_types">
        	<div id="normal_upload" style="display: none;">
                URL: <input name="userfile[]" type="text" size="55" class="input_field" /> <br />
                URL: <input name="userfile[]" type="text" size="55" class="input_field" /> <br />
                URL: <input name="userfile[]" type="text" size="55" class="input_field" /> <br />
                URL: <input name="userfile[]" type="text" size="55" class="input_field" /> <br />
                URL: <input name="userfile[]" type="text" size="55" class="input_field" /> <br />
				
                <span id="more_file_inputs"></span> <br />
            </div>
            
            <div id="webpage_upload" style="display: none;">
                URL: <input name="webpage_upload" type="text" size="50" class="input_field" value="http://www.google.com/" onclick="$(this).val('');" />
                <br /><br />
            </div>
            
            <div id="paste_upload">
           		<textarea onfocus="limitTextarea(this,40,1000)" name="paste_upload" cols="60" rows="10" class="input_field" style="width: 440px;"></textarea>
                <br />
            </div>
        </div>
		
		
		<div style="visibility: hidden">
		
		URL Upload Type: 
        <select name="url_upload_type" onchange="set_upload_type(this);">
        	<option value="paste_upload">Mass URL Upload</option>
			<option value="normal_upload">Single URL Upload</option>
        	<option value="webpage_upload">Website Upload</option>
        </select>
        
		</div>
		
        <!--
        <span id="upoptions_hidden">
        	Uploading Options: 
			<a href="javascript:void(0);" onclick="toggle('upoptions_hidden'); toggle('upoptions_shown');">
			Show Available Options
			</a>
        </span>
        -->
		
        <span id="upoptions_shown">
		<!--
       		Uploading Options: 
			<a href="javascript:void(0);" onclick="toggle('upoptions_hidden'); toggle('upoptions_shown');">
			Hide Available Options
			</a>
		-->            
            <if="$mmhclass->info->is_user == true && $mmhclass->templ->templ_globals['hide_upload_to'] == false">
            	Upload to: 
            	<select name="upload_to">
               		<option value="0" selected="selected">Root Album</option>
                    
                    <while id="albums_pulldown_whileloop">
                   		<option value="<# ALBUM_ID #>">&bull; <# ALBUM_NAME #></option>
                    </endwhile>
            	</select>
                <br />
				<br>
			</endif>
            
            <if="$mmhclass->info->is_user == false || $mmhclass->info->is_user == true && $mmhclass->info->user_data['private_gallery'] == false">
                Upload Type: 
				<input type="radio" name="private_upload" value="0" checked="checked" /> <label style="color:red">Adult/NSFW</label>
				<input type="radio" name="private_upload" value="1" /> <label style="color:green">Family Safe</label>
                <br />
            </endif>
            <div style="visibility: hidden;">
           Output Layout: 
		   <input type="radio" name="upload_type" value="url-standard" <# STANDARD_UPLOAD_YES #> /> 
		   <input type="radio" name="upload_type" checked value="url-boxed" <# BOXED_UPLOAD_YES #> /> 
		   </div>
        </span>
		
Thumbnail size:<select name="thumbsize">
<option value="100">100x100(tiny)</option>
<option value="160">160x160</option>
<option value="180" selected="selected">180x180 (standard)</option>
<option value="220">220x220(large)</option>
<option value="250">250x250(extra large)</option>
</select>

        </div>
		 <br />
		 
		 <div style="padding-top: 5px;"><input name="tos" checked="checked" type="checkbox" /> 
		 I have read and agreed to the <a target="_blank" href="/tos"> Terms of Service</a>. <br /><br />
		 </div>

		<input class="button1" type="hidden" value="Add More Files" onclick="new_file_input('url');" id="more_files_button" /> 
		<input class="button1" type="button" value="Start Uploading" onclick="toggle_lightbox('index.php?act=upload_in_progress', 'progress_bar_lightbox'); $('form[id=upload_form]').submit();" />
	</p>
</form>
<br /><br />


</center>
</template>
<!-- END: URL UPLOAD PAGE -->

<!-- BEGIN: UPLOADER PROGRESS BAR LIGHTBOX -->
<template id="upload_in_progress_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Please Stand By</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center">
            Upload in progress...
            <br /><br />
            <img src="css/images/progress_bar.gif" alt="Loading..." style="height: 40px;" />
            <br /><br />
            Your images are in the process of being uploaded.
        </td>
	</tr>
	<tr>
		<td class="table_footer">&nbsp;</td>
	</tr>
</table>

</template>
<!-- END: UPLOADER PROGRESS BAR LIGHTBOX -->

<!-- BEGIN: UPLOAD LAYOUT PREVIEW LIGHTBOX -->
<template id="upload_layout_preview_lightbox">

<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
	<tr>
		<th>Upload Layout Preview</th>
	</tr>
	<tr>
		<td class="tdrow1 text_align_center" height="<# IMAGE_HEIGHT #>px;">
			<a href="css/images/<# PREVIEW_TYPE #>layout_prev.png"><img src="css/images/<# PREVIEW_TYPE #>layout_prev.png" alt="Upload Layout Preview" /></a>
        </td>
	</tr>
	<tr>
		<td class="table_footer"><a onclick="toggle_lightbox('no_url', '<# LIGHTBOX_ID #>');">Close Window</a></td>
	</tr>
</table>

</template>
<!-- END: UPLOAD LAYOUT PREVIEW LIGHTBOX -->