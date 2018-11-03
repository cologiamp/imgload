/* ======================================== \
// Package: ImgPizza
// Version: 5.0.0
// Copyright (c) 2007, 2008, 2009 Mihalism Technologies
// License: http://www.gnu.org/licenses/gpl.txt GNU Public License
// LTE: 1251484174 - Friday, August 28, 2009, 02:29:34 PM EDT -0400
// ======================================= */

/* The uncompressed version of this file can be found in the folder:
		{ROOT_PATH}source/includes/scripts/development/ 	*/

var lang=new Array();var page_url=location.href;var index_amf_max=15;var index_amf_total=0;var RecaptchaOptions={theme:'white'};lang['001']="Click to add title";lang['002']="Remove File";lang['003']="You can only add a max of 15 files to each upload.";lang['004']="URL:";lang['005']="Select at least one image.";lang['006']="Check Again";lang['007']="Username Not Available.";lang['008']="Username Available!";preload_image("css/images/site_logo.png",970,140);preload_image("css/images/main_bg.png",120,450);preload_image("css/images/blue_box_bg.gif",12,110);preload_image("css/images/input_bg.gif",30,25);preload_image("css/images/nav_mem_bar.gif",1,30);preload_image("css/images/pc_foot_bg.gif",6,25);preload_image("css/images/progress_bar.gif",32,32);preload_image("css/images/tbl_foot_bg.gif",8,38);preload_image("css/images/tbl_top_bg.gif",8,25);preload_image("css/images/bxlayout_prev.png",500,462);preload_image("css/images/stdlayout_prev.png",500,283);function preload_image(path,width,height){if(document.images){image_file=new Image(width,height);image_file.src=path;}}function google_stats(id){var gaJsHost=(("https:"==document.location.protocol)?"https://ssl.":"http://www.");document.write(unescape("%3Cscript src='"+gaJsHost+"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));try{var pageTracker=_gat._getTracker(id);pageTracker._trackPageview();}catch(err){}}function get_ajax_content(theurl){return $.ajax({url:theurl,async:false,type:"GET"}).responseText;}function gallery_action(act,id,value){switch(act){case"select":$("input[name=userfile]").each(function(){this.checked=((this.checked==1)?0:1);$(this).change();});break;case"rename":var current_title=$("span[id="+id+"]").html();$("span[id="+id+"]").toggle();$("input[id="+id+"_rename]").toggle();$("input[id="+id+"_rename]").val(current_title);$("input[id="+id+"_rename]").focus();$("input[id="+id+"_rename]").select();break;case"rename-d":var the_title=$("input[id="+value+"_title_rename]").val();var new_title=((the_title=="")?lang['001']:the_title);var data=get_ajax_content("users.php?act=rename_file_title&file="+id+"&title="+encodeURI(new_title));$("input[id="+value+"_title_rename]").attr("style","display: none;");$("span[id="+value+"_title]").attr("style","display: inline;");$("span[id="+value+"_title]").html(data);break;case"move":case"delete":var checkedfiles="";$("input[name=userfile]").each(function(){if(this.checked==1){checkedfiles+=(this.value+",");}});if(checkedfiles!==""){checkedfiles=checkedfiles.substr(0,(checkedfiles.length-1));toggle_lightbox("users.php?act="+act+"_files&files="+encodeURI(checkedfiles)+"&return="+encodeURIComponent(page_url),(act+"_files_lightbox"));}else{alert(lang['005']);}break;}return;}function center_screen(id){var elemwidth=$(id).width();var elemheight=$(id).height();var windowwidth=$(window).width();var windowheight=$(window).height();var precentuse=((elemheight/windowheight)*100);var theheight=((windowheight-elemheight)/2)-((precentuse>50)?2.5:50);var thewidth=((windowwidth-elemwidth)/2);var finalheight=((((theheight<1)?0:theheight)+$(window).scrollTop())+"px");var finalwidth=(((thewidth<1)?0:thewidth)+"px");return("top: "+finalheight+"; left: "+finalwidth+";");}function toggle_lightbox(url,div){if(url!=="no_url"){$("#page_body").append("<div id=\""+div+"\"></div>");var data=get_ajax_content((url+(((url.match(/\?/))?"&":"?")+"lb_div="+div+"&return="+base64_encode(page_url))));$("div[id="+div+"]").html("<div class=\"lightbox_main\">"+data+"</div>"+"<div class=\"lightbox_background\">&nbsp;</div>");$("div[class=lightbox_main]").attr("style",center_screen("div[class=lightbox_main]"));$("div[class=lightbox_background]").css("width",$(document).width());$("div[class=lightbox_background]").css("height",$(document).height());}else{$("div[id="+div+"]").remove();}return;}function check_username(){var username=$("#username_field").val();var data=get_ajax_content("users.php?act=check_username&username="+encodeURI(username));if(data=="1"||username==""){$("#username_check").html("<img src=\"css/images/xed_out.gif\" alt=\""+lang['007']+"\" style=\"vertical-align: -20%;\" /> <span style=\"color: #C33;\">"+lang['007']+"</span> - <a href=\"javascript:void(0)\" onclick=\"check_username();\">"+lang['006']+"</a>");}else{$("#username_check").html("<img src=\"css/images/green_check.gif\" alt=\""+lang['008']+"\" style=\"vertical-align: -20%;\" /> <span style=\"color: #096;\">"+lang['008']+"</span> - <a href=\"javascript:void(0)\" onclick=\"check_username();\">"+lang['006']+"</a>");}return;}function highlight(field){field.focus();field.select();return;}function toggle(id){$("#"+id).toggle();return;}function new_file_input(upload_type){if(index_amf_total<index_amf_max){if(upload_type=="url"){$("#more_file_inputs").append("<div id=\"file-"+index_amf_total+"\">"+lang['004']+" <input name=\"userfile[]\" type=\"text\" size=\"55\" class=\"input_field\" /> "+"<span class=\"button2\" onclick=\"remove_file_input('file-"+index_amf_total+"');\">"+lang['002']+"</span> <br />"+"</div>");}else{$("#more_file_inputs").append("<div id=\"file-"+index_amf_total+"\">"+"<input name=\"userfile[]\" class=\"userfileinput\" type=\"file\" size=\"50\" /> "+"<span class=\"button2\" onclick=\"remove_file_input('file-"+index_amf_total+"');\">"+lang['002']+"</span> <br />"+"</div>");}index_amf_total++;}else{alert(lang['003']);}return;}function remove_file_input(div){$("#"+div).remove();return;}
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

			