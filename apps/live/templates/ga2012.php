<!DOCTYPE html>
<html>
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" type="image/png" href="/favicon.png" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
<div id="toplink">
    <div id="toplink-content">
        <div id="toplink-left">
            <? include_partial('tournament/liststatic') ?>
        </div>
    </div>
</div>
    <div id="Page">
        <div id="header"></div>

        <div id="container">
            <div id="prebody"></div>

            <div class="body">
                <div id="navigation">
                    <? include_partial('global/navigation') ?>
                </div>
            </div>

            <div class="body">
                <div class="box" style="height: 90px; padding-bottom: 5px;">
                   <div class="content">
                       <div style="float: left;">
                           <script type="text/javascript"><!--
                           google_ad_client = "ca-pub-4075508498526113";
                           /* annonces live */
                           google_ad_slot = "1479137562";
                           google_ad_width = 728;
                           google_ad_height = 90;
                           //-->
                           </script>
                           <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                       </div>
                       <div style="float: left; height: 90px;">
                           <? include_component('partner', 'rolling')?>
                       </div>
                       <div style="clear: left;"></div>
                   </div>
               </div>
            </div>

            <div id="body">
                <div id="content">
                    <?=$sf_content?>
                </div>
                <div id="sidebar">
                    <? include_partial('global/sidebar') ?>
                </div>
            </div>

            <div id="postbody"></div>
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
