<div class="navbar-inner">
  <a href="<?php echo url_for('@homepage'); ?>" class="brand">GA</a>
  <ul class="nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Informations <b class="caret"></b></A>
      <ul class="dropdown-menu">
        <li><a href="#">GA'lloween 2013</a></li>
        <li><?php echo link_to(__('Informations pratiques'), 'page/view?slug=informations-pratiques')?></li>
        <li><a href="#">Les Gamers-Assembly</a></li>
        <li><a href="#">Association Futurolan</a></li>
      </ul>
    </li>
    <li><?php echo link_to(__('Palmares'), 'page/view?slug=palmares')?></li>
    <li><?php echo link_to(__('Partenaires'), 'partner/index')?></li>
    <li><?php echo link_to(__('Presse'), 'page/view?slug=presse')?></li>
    <li><?php echo link_to(__('Contact'), 'page/view?slug=contact')?></li>
    <li class="text-right"><a href="http://forum.gamers-assembly.net" target="_blank"><?php echo __('Forum')?></a></li>
  </ul>
  <ul class="nav pull-right">
    <?php if ($sf_user->isAuthenticated()): ?>
      <li><?php echo link_to('<i class="icon-user"></i> '.$sf_user->getUsername(), 'user/profile')?></li>
      <li><?php echo link_to('<i class="icon-signout"></i> '.__('Deconnexion'), 'sfGuardAuth/signout')?></li>
    <?php else: ?>
      <li><?php echo link_to('<i class="icon-signin"></i> '.__('Connexion'), 'sfGuardAuth/signin')?></li>
      <li><?php echo link_to(__('Creer un compte'), 'sfGuardRegister/index')?></li>
    <?php endif; ?>
  </ul>
</div>
