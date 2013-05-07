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
                <?php include_partial('global/userbar') ?>
            </div>
            <div id="navigation">
                <?php include_partial('global/navigation') ?>
            </div>
        </div>

        <div id="container">
            <div id="prebody">
                <img src="http://www.gamers-assembly.net/uploads/pub/bandeau-partner.png" />
            </div>
            <div id="body">
                <div id="content">
                    <?php echo $sf_content?>
                </div>
                <div id="sidebar">
                    <?php include_partial('global/sidebar') ?>
                </div>
            </div>
            <div id="postbody">
<a href="http://goo.gl/ZHIia" target="_blank">
<img src="http://www.gamers-assembly.net/uploads/pub/medion-erazer-2.jpg" border="0" />
</a>
<br/><br/>
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
            <?php include_partial('global/footer') ?>
        </div>
    </div>

    <div id="lightoff" onclick="hideTopflashbox();">
        <?php if ($sf_user->isAuthenticated()): ?>
            <?php if ($sf_user->hasFlash('error') || $sf_user->hasFlash('success') || $sf_user->hasFlash('warning')): ?>
                <script>
                    $("#lightoff").show();
                </script>
            <?php endif; ?>
            <?php if ($sf_user->hasFlash('error')): ?>
                <div class="topflashbox toptriadix" ><?php echo $sf_user->getFlash('error')?></div>
            <?php endif; ?>
            <?php if ($sf_user->hasFlash('success')): ?>
                <div class="topflashbox topsuccess"><?php echo $sf_user->getFlash('success')?></div>
            <?php endif; ?>
            <?php if ($sf_user->hasFlash('warning')): ?>
                <div class="topflashbox topwarning"><?php echo $sf_user->getFlash('warning')?></div>
           <?php endif; ?>
        <?php endif; ?>
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
