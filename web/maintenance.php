<?php
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 1800');
header('X-Powered-By:');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Gamers Assembly</title>
    <style>
      body {
        background: url('/css/frontend/galloween2013/background.png') repeat;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        color: #222;
      }
      h1 {
        font-weight: normal;
        border-bottom: solid 1px #ddd;
        margin-bottom: 40px;
      }
      h2 {
        font-weight: normal;
        font-size: 22px;
      }
      #info {
        background-color: #fff;
        width: 650px;
        margin: auto auto;
        padding: 20px;
        border: solid 1px #ddd;
        border-radius: 5px;
        margin-top: 100px;
        box-shadow: 0px 0px 50px #ccc;
      }
      #pong {
        color: #333333;
        width: 670px;
        height: 300px;
        margin: auto auto;
        margin-top: 80px;
        border-radius: 5px;
      }
    </style>
    <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-pong.js">< /script
              < /head>
              < body >
              < div id = "info" >
              < h1 > Maintenance en cours < /h1>
              < h2 > Le site sera de retour dans quelques instants... < /h2>
    < p > Si le probl & egrave; me persiste vous pouvez nous contacter & agrave; l'adresse <a href="mailto:webmaster@futurolan.net">webmaster@futurolan.net</a>
              < /div>
              < div id = "pong" > < /div>
  < script >
            $(document).ready(function(){
    $("#pong").pong({
    "speed": 2500,
            "pad_height": 70
    });
    });
    </script>
  </body>
</html>
