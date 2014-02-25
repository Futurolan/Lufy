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
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="brand" href="<?=url_for('@homepage')?>">Administration</a>

        <ul class="nav pull-right">
          <li><a href="#"><i class="icon icon-user"></i> <?=$sf_user->getName()?></a></li>
          <li><?=ajax_link('Deconnexion', 'sfGuardAuth/signout')?></li>
        </ul>
      </div>
    </div>
  </div>

  <br/><br/><br/>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span2">
        <ul class="nav nav-list">
          <li class="nav-list-header">Navigation</li>
          <li><?= ajax_link('Tableau de bord', 'main/gamersassembly') ?></li>

          <li class="nav-header">CMS</li>
          <li><?= ajax_link('Actualit&eacute;s', 'news/index') ?></li>
          <li><?= ajax_link('Pages de contenu', 'page/index') ?></li>
          <li><?= ajax_link('Encarts', 'block/index') ?></li>
          <li><?= ajax_link('Partenaires', 'partner/index') ?></li>
          <li><?= ajax_link('Galeries photos', 'gallery/index') ?></li>
          <li><?= ajax_link('Vid&eacute;os et autres', 'file/index') ?></li>
          <li><?= ajax_link('Foire aux questions', 'faq/index') ?></li>

          <li class="nav-header">Evenements</li>
          <li><?= ajax_link('Joueurs', 'user/index') ?></li>
          <li><?= ajax_link('Equipes', 'team/index') ?></li>
          <li><?= ajax_link('Tournois', 'tournament_slot/index') ?></li>
          <li><?= ajax_link('Evenements', 'event/index') ?></li>

          <li class="nav-header">Paiements</li>
          <li><?= ajax_link('IPN Paypal', 'ipn/index') ?></li>

          <li class="nav-header">Autres</li>
          <li><?= link_to('Carte des joueurs valid&eacute;s', 'user/map', array('target' => '_blank')) ?></s></li>
          <li><?= ajax_link('Statistiques', 'stats/index') ?></li>
          <li class="divider"></li>
          <li><?=ajax_link('Param&egrave;tres', 'main/parameters')?></li>
          <li><?=ajax_link('Deconnexion', 'sfGuardAuth/signout')?></li>
        </ul>
      </div>

      <div class="span10" id="content">
        <?php echo $sf_content ?>
      </div>
    </div>
  </div>


  <div id="loader" style="display: none; width: 100%; height: 100%; text-align: center; z-index: 10; background: url('/images/black-px-40.png') repeat; position: absolute; margin-top: -40px;">
    <div style="width: 300px; text-align: center; padding: 30px; border: solid 2px #888; margin: auto auto; background: #fff;font-size: 18px; color: #666; margin-top: 200px;">
      <?=image_tag('ajax-loader.gif', array('width' => 16))?> Chargement en cours...
    </div>
  </div>

  <? include_partial('global/flash') ?>
</body>

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

</html>
