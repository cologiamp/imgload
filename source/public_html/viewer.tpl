<!-- BEGIN: MAIN VIEWER PAGE -->
<template id="viewer_image">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53862630-1', 'auto');
  ga('send', 'pageview');

</script>

<if="$mmhclass->templ->templ_globals['new_file_rating'] == true">
	<# NEW_RATING_HTML #><hr />
</endif>

<!-- Begin Exoclick PopUnder Code -->
<script type="text/javascript" src="http://syndication.exoclick.com/splash.php?idzone=1070040&type=3"></script>
<!-- Begin Exoclick PopUnder Code -->


<!-- Begin JuicyAds PopUnder Code -->
<script type="text/javascript">juicy_code='74c4y2w2r256r2p2r2a463c4';</script>
<script type="text/javascript" src="http://ads.juicyads.com/jsclients/jac.js" charset="utf-8"></script>
<!-- End JuicyAds PopUnder Code -->

<script type="text/javascript">
        // <![CDATA[
        var scaled = false;

        function scaleonload() {
            e = document.getElementById('show_image');
            scale(e);
        }

        function scale(e) {

            if (scaled) {
                e.width = originalWidth;
                e.height = originalHeight;
                scaled = false;
            } else {
                if (e.width > 890) {
                    originalWidth = e.width;
                    originalHeight = e.height;
                    e.style.cursor = "url(theme/magnify.cur), default";
                    e.width = 890;
                    e.height = Math.ceil(890 * (originalHeight / originalWidth));
                    scaled = true;
                }
            }
        }

        // ]]>

    </script>
	
<div class="text_align_center">
	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['is_random']) == false">
		<a href="index.php?do_random=1" class="button1">New Random Image</a>
        <br /><br />
	</endif>

	<if="$mmhclass->templ->templ_globals['familysafe'] == 1">
		<div align="center">
		<!-- BEGIN Ad Tag EXOCLICK-->
		<!-- BEGIN SMOWTION TAG - 728x90 - DO NOT MODIFY -->
		<script type="text/javascript">
		smowtion_size = "728x90";
		smowtion_section = "6151373";
		</script>
		<script type="text/javascript"
		src="http://ads.smowtion.com/ad.js?s=6151373&amp;z=728x90">
		</script>
		<!-- END SMOWTION TAG - 728x90 - DO NOT MODIFY -->
		<!-- END Ad Tag EXOCLICK-->
		</div>

	<else>
		<!--JuicyAds v2.0-->
		<iframe border=0 frameborder=0 marginheight=0 marginwidth=0 width=616 height=258 scrolling=no allowtransparency=true src=http://adserver.juicyads.com/adshow.php?adzone=323549></iframe>
		<!--JuicyAds END-->		
	</endif>
		<br>
		<br>
	<img id="cursor_lupa" onload="scale(this);" onclick="scale(this);" src="<# UPLOAD_PATH #><# FILENAME #>" alt="<# REAL_FILENAME #>" style="cursor: url(/source/cursor.cur), default; padding: 2px;"/>
	
	<if="$mmhclass->templ->templ_globals['file_info']['width'] > 940">
		<br /><br />
		<b>Resize</b>: The above image has been resized to better fit your screen. To view its true size, click it.
	</endif>
	<br>
	<br>

	<if="$mmhclass->templ->templ_globals['familysafe'] == 1">
		<div align="center">

		</div>
	<else>
		<div style="margin-left:-305px;">
		<div style="margin: 0 0 0 0;">
		<!-- BEGIN Ad Tag EXOCLICK-->
		<script type="text/javascript">
		ad_idzone = "1069986";
		ad_width = "300";
		ad_height = "250";
		</script>
		<script type="text/javascript" src="https://ads.exoclick.com/ads.js"></script>
		<noscript><a href="http://main.exoclick.com/img-click.php?idzone=1069986" target="_blank"><img src="https://syndication.exoclick.com/ads-iframe-display.php?idzone=1069986&output=img&type=300x250" width="300" height="250"></a></noscript>
		<!-- END Ad Tag EXOCLICK-->
		</div>
		<div style="margin:-250px 0 0 605px;">
		<!-- BEGIN Ad Tag EXOCLICK-->
		<script type="text/javascript">
		ad_idzone = "1069990";
		ad_width = "300";
		ad_height = "250";
		</script>
		<script type="text/javascript" src="https://ads.exoclick.com/ads.js"></script>
		<noscript><a href="http://main.exoclick.com/img-click.php?idzone=1069990" target="_blank"><img src="https://syndication.exoclick.com/ads-iframe-display.php?idzone=1069990&output=img&type=300x250" width="300" height="250"></a></noscript>
		<!-- END Ad Tag -->
		</div>
		</div>

	</endif>
	<br>
	<br>
</div>

<center>

<div class="align_left_mfix">
    <a href="download.php?file=<# FILENAME #>" class="button1">Download Image</a> 
    <a href="contact.php?act=file_report&amp;file=<# FILENAME #>" class="button1">Report Image</a> 
    
	<!--
	<span onclick="toggle('file_rating_block');" class="button1">Rate Image</span>
    <a href="links.php?file=<# FILENAME #>" class="button1">Image Links</a>
	-->
</div>
</center>

<br /><br />



	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<th colspan="2">Image Meta Information</th>
		</tr>
		<tr>
			<td colspan="2" class="tdrow2"><# FILE_LINKS #></td>
		</tr>
		<tr>
			<td colspan="2" class="table_footer">&nbsp;</td>
		</tr>
	</table>

</template>
<!-- END: MAIN VIEWER PAGE -->

<!-- BEGIN: MAIN VIEWER PAGE -->
<template id="viewer_image2">

<!-- Begin JuicyAds PopUnder Code -->
<script type="text/javascript">juicy_code='74c4y2w2r256r2p2r2a463c4';</script>
<script type="text/javascript" src="http://ads.juicyads.com/jsclients/jac.js" charset="utf-8"></script>
<!-- End JuicyAds PopUnder Code -->


<!-- EXOCLICK PopUnder Code -->
<!-- Begin Exoclick PopUnder Code -->
<script type="text/javascript" src="http://syndication.exoclick.com/splash.php?idzone=1070040&type=3"></script>
<!-- Begin Exoclick PopUnder Code -->
<!-- EXOCLICK PopUnder Code -->


<if="$mmhclass->templ->templ_globals['new_file_rating'] == true">
	<# NEW_RATING_HTML #><hr />
</endif>


<script type="text/javascript">
        // <![CDATA[
        var scaled = false;

        function scaleonload() {
            e = document.getElementById('show_image');
            scale(e);
        }

        function scale(e) {

            if (scaled) {
                e.width = originalWidth;
                e.height = originalHeight;
                scaled = false;
            } else {
                if (e.width > 890) {
                    originalWidth = e.width;
                    originalHeight = e.height;
                    e.style.cursor = "url(theme/magnify.cur), default";
                    e.width = 890;
                    e.height = Math.ceil(890 * (originalHeight / originalWidth));
                    scaled = true;
                }
            }
        }

        // ]]>

    </script>
	
<div class="text_align_center">
	<if="$mmhclass->funcs->is_null($mmhclass->input->get_vars['is_random']) == false">
		<a href="index.php?do_random=1" class="button1">New Random Image</a>
        <br /><br />
	</endif>

	<if="$mmhclass->templ->templ_globals['familysafe'] == 1">
		<!-- BEGIN Ad Tag EXOCLICK-->
		<!-- BEGIN SMOWTION TAG - 728x90 - DO NOT MODIFY -->
		<script type="text/javascript">
		smowtion_size = "728x90";
		smowtion_section = "6151373";
		</script>
		<script type="text/javascript"
		src="http://ads.smowtion.com/ad.js?s=6151373&amp;z=728x90">
		</script>
		<!-- END SMOWTION TAG - 728x90 - DO NOT MODIFY -->
		<!-- END Ad Tag EXOCLICK-->
	<else>
		<!--JuicyAds v2.0-->
		<iframe border=0 frameborder=0 marginheight=0 marginwidth=0 width=616 height=258 scrolling=no allowtransparency=true src=http://adserver.juicyads.com/adshow.php?adzone=323549></iframe>
		<!--JuicyAds END-->		
	</endif>
		<br>
		<br>
	<img id="cursor_lupa" onload="scale(this);" onclick="scale(this);" src="<# UPLOAD_PATH #><# FILENAME #>" alt="<# REAL_FILENAME #>" style="cursor: url(/source/cursor.cur), default; padding: 2px;"/>
	
	<if="$mmhclass->templ->templ_globals['file_info']['width'] > 940">
		<br /><br />
		<b>Resize</b>: The above image has been resized to better fit your screen. To view its true size, click it.
	</endif>
	<br>
	<br>

	<if="$mmhclass->templ->templ_globals['familysafe'] == 1">
		<div align="center">
		<!-- BEGIN Ad Tag EXOCLICK-->

		<!-- END Ad Tag EXOCLICK-->
		</div>
	<else>
		<div style="margin-left:-305px;">

		<div style="margin: 0 0 0 0;">
		<!-- BEGIN Ad Tag EXOCLICK-->
		<script type="text/javascript">
		ad_idzone = "1069986";
		ad_width = "300";
		ad_height = "250";
		</script>
		<script type="text/javascript" src="https://ads.exoclick.com/ads.js"></script>
		<noscript><a href="http://main.exoclick.com/img-click.php?idzone=1069986" target="_blank"><img src="https://syndication.exoclick.com/ads-iframe-display.php?idzone=1069986&output=img&type=300x250" width="300" height="250"></a></noscript>
		<!-- END Ad Tag EXOCLICK-->
		</div>
		<div style="margin:-250px 0 0 605px;">
		<!-- BEGIN Ad Tag EXOCLICK-->
		<script type="text/javascript">
		ad_idzone = "1069990";
		ad_width = "300";
		ad_height = "250";
		</script>
		<script type="text/javascript" src="https://ads.exoclick.com/ads.js"></script>
		<noscript><a href="http://main.exoclick.com/img-click.php?idzone=1069990" target="_blank"><img src="https://syndication.exoclick.com/ads-iframe-display.php?idzone=1069990&output=img&type=300x250" width="300" height="250"></a></noscript>
		<!-- END Ad Tag -->
		</div>
		</div>
	</endif>
	<br>
	<br>
</div>


<center>
<div class="align_left_mfix">
    <a href="download.php?file=<# FILENAME #>" class="button1">Download Image</a> 
    <a href="contact.php?act=file_report&amp;file=<# FILENAME #>" class="button1">Report Image</a> 
    
	<!--
	<span onclick="toggle('file_rating_block');" class="button1">Rate Image</span>
    <a href="links.php?file=<# FILENAME #>" class="button1">Image Links</a>
	-->
</div>
</center>

<br /><br />



	<table cellpadding="4" cellspacing="1" border="0" style="width: 100%;">
		<tr>
			<th colspan="2">Image Meta Information</th>
		</tr>
		<tr>
			<td colspan="2" class="tdrow2"><# FILE_LINKS #></td>
		</tr>
		<tr>
			<td colspan="2" class="table_footer">&nbsp;</td>
		</tr>
	</table>

</template>
<!-- END: MAIN VIEWER PAGE -->