<div class="box">
    <div class="title"><?php echo $homepage->getTitle()?></div>
  <div class="content">

    <div style="width: 425px; float: left; margin-right: 25px;">
      <div class="subtitle">Actualit&eacute;s</div>
      <?php include_component('news', 'actualite'); ?>
    </div>

    <div style="width: 325px; float: left; margin-left: 25px;">
      <div class="subtitle">Prochain &eacute;v&egrave;nement</div>
      <div>
        <a href="http://www.gamers-assembly.net/fr"><img src="http://presse.futurolan.net/uploads/assets/next-event-presse.png" border="0" border="0"/></a>
      </div>
    </div>

    <div style="clear: left;">&nbsp;</div>

    <?php echo $homepage->getContent(ESC_RAW)?>

  </div>
</div>
