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
  <header></header>

  <div class="container">
    <nav class="navbar">
      <?php include_partial('global/navigation') ?>
    </nav>

    <div id="wrap" class="row">
      <div class="span9">
        <div id="content">
          <?php echo $sf_content?>
        </div>
      </div>
      <div class="span3">
        <div id="sidebar">
          <?php include_partial('global/sidebar') ?>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <?php include_partial('global/footer') ?>
    </div>
  </footer>

  <?php include_partial('global/flash') ?>

  <script>
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
