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
  <div id="Page">
     
      <div id="Slider">
        <?php include_component('news', 'affiche'); ?>
      </div>
    <div id="Navigation">
        <?php include_partial('global/navigation');?>
    </div>
    <div id="Partner">
      <?php include_component('partner', 'principal');?>
      <?php include_component('partner', 'officiel');?>
    </div>
    <div id="Body-top">
      </div>
      <div id="Login">
        <?php if ($sf_user->isAuthenticated()): ?>
          <ul>
	        <li><?php echo link_to(image_tag('13/house.png').' '.$sf_user->getUsername(), 'user/index')?> <?php include_component('invite', 'nbinvite') ?></li>
<!--
            <li><?php echo link_to(image_tag('13/group.png').' '.__('Mon équipe'), 'team/index')?></li>
            <li><?php echo link_to(image_tag('13/star.png').' '.__('Mon inscription'), 'tournament_slot/index')?></li>
-->
            <li><?php echo link_to(image_tag('13/key.png').' '.__('Deconnexion').' &nbsp;', 'sfGuardAuth/signout')?></li>
          </ul>
	    <?php else: ?>
          <ul>
            <li><?php echo link_to(image_tag('13/key.png').' '.__('Connexion'), 'sfGuardAuth/signin')?></li>
            <li><?php echo link_to(image_tag('13/user.png').' '.__('Créer un compte').' &nbsp;', 'sfGuardRegister/index')?></li>
          </ul>
        <?php endif; ?>
       </div>
    <div id="Body">
      <div id="Content">
        <?php if ($sf_user->isAuthenticated()): ?>
            <?php if ($sf_user->hasFlash('error')): ?>
                <div class="flashbox triadix" ><?php echo $sf_user->getFlash('error')?></div>
            <?php endif; ?>
            <?php if ($sf_user->hasFlash('success')): ?>
                <div class="flashbox success"><?php echo $sf_user->getFlash('success')?></div>
            <?php endif; ?>
            <?php if ($sf_user->hasFlash('warning')): ?>
                <div class="flashbox warning"><?php echo $sf_user->getFlash('warning')?></div>
            <?php endif; ?>
        <?php endif; ?>
        <?php echo $sf_content ?>
      </div>
      <div id="Sidebar">
        <!--
        <h3>Partenaires m&eacute;dia</h3>
        <?php //include_component('partner', 'media');?>
        <div class="spacer-10"></div>
        -->
        <h3><?php echo __('Tournois')?></h3>
        <!--
	<div style="text-align: right;"><span class="button"><?php echo link_to('Voir les &eacute;quipes inscrites', 'tournament/list?slug=none')?></span></div>
	-->
        <?php include_component('tournament', 'nexttournament');?>
        <!--
        <?php //include_component('poker_tournament', 'list');?>
        -->
        <div class="spacer-10"></div>
        <div class="spacer-10"></div>
        <?php echo link_to(image_tag('../css/gamersassembly/img/aide-faq.png'), 'faq/index') ?></a><br/><br/>
        <?php echo link_to(image_tag('../css/gamersassembly/img/aide-contact.png'), 'page/view?slug=decouvrez-l-association-futurolan') ?></a>
      </div>
      <div class="clear-left"></div>
      <div>
        <?php // include_component('partner', 'organisation');?>
      </div>
    </div>
      <div id="Footer">
      <div id="FooterContent">
        <?php include_partial('global/footer');?>
      </div>
    </div>
  </div>

  <script type="text/javascript">
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
