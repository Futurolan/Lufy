<!DOCTYPE html>
<html>
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <meta name="google-site-verification" content="BD4f6AD6soTAxAuqiTT3ftDHFazILx0x4smwhDntF1M" />
    <?php include_title() ?>
    <link rel="shortcut icon" type="image/png" href="/favicon.png" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
    <div id="Page">
        <div id="header">
            <div id="userbar">
                <? include_partial('global/userbar') ?>
            </div>
            <div id="navigation">
                <? include_partial('global/navigation') ?>
            </div>
        </div>

        <div id="container">
            <div id="prebody">
            </div>
            <div id="body">
                <div id="content">
                    <?=$sf_content?>
                </div>
                <div id="sidebar">
                    <? include_partial('global/sidebar') ?>
                </div>
            </div>
            <div id="postbody">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-4075508498526113";
/* Annonce large */
google_ad_slot = "0217089174";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
            </div>
            <div style="clear:left;"></div>
        </div>

        <div id="footer">
            <? include_partial('global/footer') ?>
        </div>
    </div>

    <div id="lightoff" onclick="hideTopflashbox();">
        <? if ($sf_user->isAuthenticated()): ?>
            <? if ($sf_user->hasFlash('error') || $sf_user->hasFlash('success') || $sf_user->hasFlash('warning')): ?>
                <script>
                    $("#lightoff").show();
                </script>
            <? endif; ?>
            <? if ($sf_user->hasFlash('error')): ?>
                <div class="topflashbox toptriadix" ><?=$sf_user->getFlash('error')?></div>
            <? endif; ?>
            <? if ($sf_user->hasFlash('success')): ?>
                <div class="topflashbox topsuccess"><?=$sf_user->getFlash('success')?></div>
            <? endif; ?>
            <? if ($sf_user->hasFlash('warning')): ?>
                <div class="topflashbox topwarning"><?=$sf_user->getFlash('warning')?></div>
           <? endif; ?>
        <? endif; ?>
    </div>

  <script type="text/javascript">
  function hideTopflashbox() {
    $("#lightoff").hide();
  }

   var _gaq = _gaq || [];
   _gaq.push(['_setAccount', 'UA-183270-3']);
   _gaq.push(['_trackPageview']);
   (function() {
     var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
     ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
   })();
  </script>

</body>
</html>
