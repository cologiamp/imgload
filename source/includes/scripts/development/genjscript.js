var lang = new Array();
var page_url = location.href;
var index_amf_max = 15;
var index_amf_total  = 0;
/* reCAPTCHA Settings */
var RecaptchaOptions = { theme : 'white' }; 

/* Language Settings */

lang['001'] = "Click to add title"; // File title if no title is set
lang['002'] = "Remove File"; // Notice to be used to remove a image upload field
lang['003'] = "You can only add a max of 15 files to each upload."; // Error to be displayed if too many new image upload fields are added
lang['004'] = "URL:"; // Notice to be used to indicate a image upload field is for an URL
lang['005'] = "Select at least one image."; // Error to be displayed if no images are selected to delete or move on button press
lang['006'] = "Check Again"; // Notice to be used when to recheck username availablity 
lang['007'] = "Username Not Available."; // Notice to be used when an username is not available
lang['008'] = "Username Available!"; // Notice to be used when an username is available

/* DO NOT EDIT PAST THIS LINE UNLESS YOU KNOW WHAT YOU ARE DOING */


preload_image("css/images/blue_box_bg.gif", 12, 110);
preload_image("css/images/input_bg.gif", 30, 25);
preload_image("css/images/progress_bar.gif", 32, 32);


function preload_image(path, width, height) 
{
	if (document.images) {
		image_file = new Image(width, height); 
		image_file.src = path;
	}
}

function google_stats(id)
{
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	try {
		var pageTracker = _gat._getTracker(id);
		pageTracker._trackPageview();
	} catch(err) {}	
}

function get_ajax_content(theurl) 
{
	return $.ajax({
  		url: theurl,
		async: false
	}).responseText;
}

function gallery_action(act, id, value)
{	
	switch (act) {
		case "select":
			$("input[name=userfile]").each(function()
			{
				this.checked = ((this.checked == 1) ? 0 : 1);
				$(this).change();
			});      
			break;
		case "rename":
			var current_title = $("span[id=" + id + "]").html();
			$("span[id=" + id + "]").toggle();
			$("input[id=" + id + "_rename]").toggle();
			$("input[id=" + id + "_rename]").val(current_title);
			$("input[id=" + id + "_rename]").focus();
			$("input[id=" + id + "_rename]").select();
			break;
		case "rename-d":
			var the_title = $("input[id=" + value + "_title_rename]").val();
			var new_title = ((the_title == "") ? lang['001'] : the_title);
			var data = get_ajax_content("users.php?act=rename_file_title&file=" + id + "&title=" + encodeURI(new_title));
			/* The jQuery toggle() method is not used to fix a known bug. */
			$("input[id=" + value + "_title_rename]").attr("style", "display: none;");
			$("span[id=" + value + "_title]").attr("style", "display: inline;");
			$("span[id=" + value + "_title]").html(data);
			break;
		case "move":
		case "delete":
			var checkedfiles = "";
			$("input[name=userfile]").each(function()
			{
				if (this.checked == 1) {
					checkedfiles += (this.value + ",");
				}
			});      
			if (checkedfiles !== "") {
				checkedfiles = checkedfiles.substr(0, (checkedfiles.length - 1));
				toggle_lightbox("users.php?act=" + act + "_files&files=" + encodeURI(checkedfiles) + "&return=" + encodeURIComponent(page_url), (act + "_files_lightbox"));
			} else {
				alert(lang['005']);
			}
			break;
		case "merge":
			var checkedfiles = "";
			count=0;
			$("input[name=userfile]").each(function()
			{
				if (this.checked == 1) {
					checkedfiles += (this.value + ",");
					count++;
				}
			});      
			if(count<2)
				break;
			if (checkedfiles !== "") {
				checkedfiles = checkedfiles.substr(0, (checkedfiles.length - 1));
				toggle_lightbox("users.php?act=" + act + "_albums&albums=" + encodeURI(checkedfiles) + "&return=" + encodeURIComponent(page_url), (act + "_files_lightbox"));
			} else {
				alert(lang['005']);
			}
			break;
	}
	return;
}

function center_screen(id)
{
	// Lots of variables
	var elemwidth = $(id).width();
    var elemheight = $(id).height();
    var windowwidth = $(window).width();
    var windowheight = $(window).height();
	var precentuse = ((elemheight / windowheight ) * 100);
   	var theheight = ((windowheight - elemheight) / 2) - ((precentuse > 50) ? 2.5 : 50);
    var thewidth = ((windowwidth - elemwidth) / 2);
    var finalheight = ((((theheight < 1) ? 0 : theheight) + $(window).scrollTop()) + "px");
    var finalwidth = (((thewidth < 1) ? 0 : thewidth) + "px");
    return ("top: " + finalheight + "; left: " + finalwidth + ";");
}

function toggle_lightbox(url, div)
{
	if (url !== "no_url") {
		//scroll(0, 0);
		$("#page_body").append("<div id=\"" + div + "\"></div>");
		var data = get_ajax_content((url + (((url.match(/\?/)) ? "&" : "?") + "lb_div=" + div + "&return=" + base64_encode(page_url))));
		$("div[id=" + div + "]").html("<div class=\"lightbox_main\">" + data + "</div>" +
				"<div class=\"lightbox_background\">&nbsp;</div>");
		$("div[class=lightbox_main]").attr("style", center_screen("div[class=lightbox_main]"));
		$("div[class=lightbox_background]").css("width", $(document).width());
		$("div[class=lightbox_background]").css("height", $(document).height());
	} else {
		$("div[id=" + div + "]").remove();
	}
	return;
}

function check_username()
{
	var username = $("#username_field").val();    
	var data = get_ajax_content("users.php?act=check_username&username=" + encodeURI(username));
	if (data == "1" || username == "") {
		$("#username_check").html("<img src=\"css/images/xed_out.gif\" alt=\"" + lang['007'] + "\" style=\"vertical-align: -20%;\" /> <span style=\"color: #C33;\">" + lang['007'] + "</span> - <a href=\"javascript:void(0)\" onclick=\"check_username();\">" + lang['006'] + "</a>");
	} else {
		$("#username_check").html("<img src=\"css/images/green_check.gif\" alt=\"" + lang['008'] + "\" style=\"vertical-align: -20%;\" /> <span style=\"color: #096;\">" + lang['008'] + "</span> - <a href=\"javascript:void(0)\" onclick=\"check_username();\">" + lang['006'] + "</a>");
	}
	return;
}

function highlight(field) 
{
	field.focus();
	field.select();
	return;
}

function toggle(id) 
{
	$("#" + id).toggle();
	return;
}

function new_file_input(upload_type) 
{
	if (index_amf_total < index_amf_max) {
		if (upload_type == "url") {
			$("#more_file_inputs").append("<div style=\"margin-left: -3px;\" id=\"file-" +  index_amf_total + "\">" +
						lang['004'] + " <input name=\"userfile[]\" type=\"text\" size=\"55\" class=\"userfileinput\" /> " +
						"</div>");
		} else {
			document.getElementById("file-" +  index_amf_total + "").style.display = "inline-block";
		}
		index_amf_total++;
	} else {
		alert(lang['003']);
	}
	return;
}

function remove_file_input(div)
{
	$("#" + div).remove();
	return;
}

/* function to display file name when selected */
$.fn.fileName = function() {
	var $this = $(this),
	$val = $this.val(),
	valArray = $val.split('\\'),
	newVal = valArray[valArray.length-1],
	$button = $this.siblings('.button');
	if(newVal !== '') {
		$button.text(newVal);
  	}
};

$().ready(function() {
	/* on change, focus or click call function fileName */
	$('input[type=file]').bind('change focus click', function() {$(this).fileName()});
});


function loginMenu(){
        		if (document.getElementById('loginMenu').style.display == 'none'){
        			document.getElementById('loginMenu').style.display = 'block';
        			$("#loginTab").attr("class","button6");


        		}
        	}

function cerrarmenu(){
        		if (document.getElementById('loginMenu').style.display == 'block'){
        			document.getElementById('loginMenu').style.display = 'none';
        			$("#loginTab").attr("class","button6");


        		}
        	}

			
			
			
			
			
			
var alert_title='Input Restriction';

function limitTextarea(el,maxLines,maxChar){
if(!el.x){
el.x=uniqueInt();
el.onblur=function(){clearInterval(window['int'+el.x])}
}
window['int'+el.x]=setInterval(function(){
var lines=el.value.replace(/\r/g,'').split('\n'),
i=lines.length,
lines_removed,
char_removed;
if(maxLines&&i>maxLines){
alert('You can not enter\nmore than '+maxLines+' lines');
lines=lines.slice(0,maxLines);
lines_removed=1
}
if(maxChar){
i=lines.length;
while(i-->0)if(lines[i].length>maxChar){
lines[i]=lines[i].slice(0,maxChar);
char_removed=1
}
if(char_removed)alert('You can not enter more\nthan '+maxChar+' characters per line')
}
if(char_removed||lines_removed)el.value=lines.join('\n')
},50);
}

function uniqueInt(){
var num,maxNum=100000;
if(!uniqueInt.a||maxNum<=uniqueInt.a.length)uniqueInt.a=[];
do num=Math.ceil(Math.random()*maxNum);
while(uniqueInt.a.hasMember(num))
uniqueInt.a[uniqueInt.a.length]=num;
return num
}

Array.prototype.hasMember=function(testItem){
var i=this.length;
while(i-->0)if(testItem==this[i])return 1;
return 0
};

function set_ie_alert(){
window.alert=function(msg_str){
vb_alert(msg_str)
}
}



        // <![CDATA[
        var scaled = false;

        function scaleonload() {
            e = document.getElementById('cursor_lupa');
            scale(e);
        }

        function scale(e) {

            if (scaled) {
                e.width = originalWidth;
                e.height = originalHeight;
                scaled = false;
            } else {
                if (e.width > 880) {
                    originalWidth = e.width;
                    originalHeight = e.height;
                    e.style.cursor = "url(/source/cursor.cur), default";
                    e.width = 880;
                    e.height = Math.ceil(880 * (originalHeight / originalWidth));
                    scaled = true;
                }
            }
        }

        // ]]>

			