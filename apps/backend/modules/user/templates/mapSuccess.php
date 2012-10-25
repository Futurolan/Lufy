<div id="content">
    MAP
</div>
<div class="locations">
<ul>
<?
$i = 0;
foreach ($users as $user):
    $i++;
    echo '<li><strong>'.$i.'</strong> '.$user->getAddress().' '.$user->getZipcode().' '.$user->getCity().'</li>';
endforeach;
?>
</ul>
</div>
<script src="http://github.com/codepo8/geotoys/raw/master/addmap.js"></script>
<script>
addmap.config.mapkey = 'ABQIAAAAb9MIA3i6z1KVDaal49rGHBS8haGdA2w5bXNNvuMJf0HHkT8WlxRa0ZjWf6kXYIV1qdI_wZ6i7fQKSQ';
addmap.analyse('content');
</script>

  <style type="text/css" media="screen">
    .locations{background:#efe;border:1px solid #999;-moz-border-radius:5px;
               -moz-box-shadow:-2px 2px 2px rgba(66,66,66,.3);
               position:relative;}
    #content p.branding{position:absolute;font-size:10px;
                        bottom:5px;right:5px;}
    .locations img{float:left;}
    .locations {overflow:auto;height:200px;}
    .locations ul{float:left;}
    #ft p{
      text-align:right;
      margin:3em;
      font-size:80%;
    }
    a {color:#369;}
    #content p{
      font-size:110%;
      font-weight:bold;
    }
    h1,h2,h3{
      font-family:calibri,sans-serif;
    }
    #content{
      border:1px solid #999;
      border-left:none;
      border-right:none;
      padding:1em 0;
      margin:1em 0;
    }
  </style>
