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
                <?=ajax_link('Vider le cache', 'main/clearCache')?> | 
                <?=ajax_link('Param&egrave;tres', 'main/parameters')?> | 
                <?=ajax_link('Deconnexion', 'sfGuardAuth/signout')?>
            </div>
        </div>
        <div id="body">
            <div id="navigation">
                <h2>NAVIGATION</h2>
                <?= ajax_link('Tableau de bord', 'main/gamersassembly') ?>
                <h3>CMS</h3>
                <ul class="list">
                    <li><?= ajax_link('Actualit&eacute;s', 'news/index') ?></li>
                    <li><?= ajax_link('Pages de contenu', 'page/index') ?></li>
                    <li><?= ajax_link('Encarts', 'block/index') ?></li>
                    <li><?= ajax_link('Partenaires', 'partner/index') ?></li>
                    <li><?= ajax_link('Galeries photos', 'gallery/index') ?></li>
                    <li><?= ajax_link('Vid&eacute;os et autres', 'file/index') ?></li>
                    <li><?= ajax_link('Foire aux questions', 'faq/index') ?></li>
                </ul>

                <h3>Evenements</h3>
                <ul class="list">
                    <li><?= ajax_link('Joueurs', 'user/index') ?></li>
                    <li><?= ajax_link('Equipes', 'team/index') ?></li>
                    <li><?= ajax_link('Tournois', 'tournament_slot/index') ?></li>
                    <li><?= ajax_link('Joueurs Poker', 'poker_tournament_player/index') ?></li>
                    <li><?= ajax_link('Tournois Poker', 'poker_tournament/index') ?></li>
                    <li><?= ajax_link('Evenements', 'event/index') ?></li>
                </ul>

                <h3>Paiements</h3>
                <ul class="list">
                    <li><?= ajax_link('Commandes', 'commande/index') ?></li>
                    <li><?= ajax_link('Paiements', 'payement/index') ?></li>
                    <li><?= ajax_link('IPN Paypal', 'ipn/index') ?></li>
                </ul>

                <h3>Autres</h3>
                <ul class="list">
                    <li><s><?= ajax_link('Newsletter', 'newsletter/index') ?></s></li>
                    <li><?= ajax_link('Statistiques', 'stats/index') ?></li>
                    <li>&nbsp;</li>
                    <li><?=ajax_link('Param&egrave;tres', 'main/parameters')?></li>
                    <li><?=ajax_link('Deconnexion', 'sfGuardAuth/signout')?></li>
                </ul>

            </div>
            <div id="content">
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
