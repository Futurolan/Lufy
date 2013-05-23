<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div id="header">
            <h1>Administration</h1>
            <div id="subHeader">
                <a href="http://www.gamers-assembly.net/fr">Gamers Assembly</a>
                <a href="http://presse.futurolan.net">Espace presse</a>
                <a href="http://backend.gamers-assembly.net/">Backend</a>
            </div>
        </div>
        <div id="body" style="width: 90%;">
            <div id="content" style="width: 100%; margin: 0px;">
                <? if ($sf_user->hasFlash('success')) echo '<div class="flashbox success">'.$sf_user->getFlash('success').'</div>'; ?>
                <? if ($sf_user->hasFlash('info')) echo '<div class="flashbox info">'.$sf_user->getFlash('info').'</div>'; ?>
                <? if ($sf_user->hasFlash('warning')) echo '<div class="flashbox warning">'.$sf_user->getFlash('warning').'</div>'; ?>
                <? if ($sf_user->hasFlash('error')) echo '<div class="flashbox error">'.$sf_user->getFlash('error').'</div>'; ?>
              <?php echo $sf_content ?>
            </div>
        </div>

<script>
$(window).ready(function() {
  if (location.hash) {
    $('#loader').fadeIn();
    var jqxhr = $.get(
      location.hash.substring(1),
      {},
      function success(data) {
        $('#content').html(data);
        $('#loader').fadeOut();
      }
    );
  }
});
</script>

        <div id="loader" style="display: none; width: 100%; height: 100%; text-align: center; z-index: 10; background: url('/images/black-px-40.png') repeat; position: absolute; margin-top: -40px;">
          <div style="width: 300px; text-align: center; padding: 30px; border: solid 2px #888; margin: auto auto; background: #fff;font-size: 18px; color: #666; margin-top: 200px;">
            <?=image_tag('ajax-loader.gif', array('width' => 16))?> Chargement en cours...
          </div>
        </div>

    </body>
</html>
