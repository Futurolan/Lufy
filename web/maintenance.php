<!DOCTYPE html>
<html>
<head>
  <title>Gamers Assembly 2013</title>
  <style>
  <!--
  body {
    background-color: #000000;
    color: #fff;
  }
  #logo {
    text-align: center;
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 10;
    width: 100%;
  }
  #ouverture {
    text-align: center;
    position: fixed;
    bottom: 30px;
    right: 10px;
    z-index: 10;
  }
  #facebook {
    position: fixed;
    bottom: 40px;
    left: 20px;
    z-index: 10;
    width: 100%;
  }
  #player {
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 1;
    width: 100%;
    height: 100%;
  }
  -->
  </style>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<body>
  <div id="logo">
    <img src="logo.png" />
  </div>
  
  <div id="ouverture">
    <img src="ouverture.png" />
  </div>
  
  <div id="facebook">
    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=183148825128872";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like" data-href="http://www.gamers-assembly.net/" data-send="true" data-width="500" data-show-faces="true" data-colorscheme="dark"></div>
  </div>
  
  <div id="player">
    <iframe frameborder="0" width="100%" height="100%" src="http://www.dailymotion.com/embed/video/xwnkua?logo=0&autoPlay=1"></iframe>
  </div>
  
  <script type="text/javascript"><!--
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