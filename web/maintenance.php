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
    #info {
      text-align: center;
      margin-top: 100px;
    }
  </style>
</head>
<body>
<div id="info">
  <h1>Maintenance en cours</h1>
  <h2>Le site sera de retour dans quelques instants...</h2>
</div>
</body>
</html>
