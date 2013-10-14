<div class="navbar-inner">
  <a href="<?php echo url_for('@homepage'); ?>" class="brand"></a>
  <ul class="nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Informations <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <?php include_component('event', 'last') ?>
        <li><?php echo ajax_link(__('Informations pratiques'), '@page_view?slug=informations-pratiques')?></li>
        <li class="divider"></li>
        <li><?php echo ajax_link(__('Les Gamers Assembly'), '@page_view?slug=presentation')?></li>
        <li><?php echo ajax_link(__('Association Futurolan'), '@page_view?slug=decouvrez-l-association-futurolan')?></li>
        <li class="divider"></li>
        <li><?php echo ajax_link(__('FAQ'), '@faq_index')?></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Archives') ?> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li class="dropdown-submenu">
          <a href="#"><?php echo __('Photos') ?></a>
          <ul class="dropdown-menu">
            <?php include_component('gallery', 'list') ?>
          </ul>
        </li>
        <li class="dropdown-submenu">
          <a href="#"><?php echo __('Videos') ?></a>
          <ul class="dropdown-menu">
            <li><a href="#"><?php echo __('A venir') ?></a></li>
          </ul>
        </li>
        <li><?php echo ajax_link(__('Palmares'), '@page_view?slug=palmares')?></li>
      </ul>
    </li>
    <li><?php echo ajax_link(__('Partenaires'), '@partner_index')?></li>
    <li><?php echo ajax_link(__('Presse'), '@page_view?slug=presse')?></li>
    <li><?php echo ajax_link(__('Contact'), '@page_view?slug=contact')?></li>
    <li class="text-right"><a href="http://forum.gamers-assembly.net" target="_blank"><?php echo __('Forum')?></a></li>
  </ul>
  <ul class="nav pull-right">
    <?php if ($sf_user->isAuthenticated()): ?>
      <li><?php echo ajax_link('<i class="icon-user"></i> '.$sf_user->getUsername(), 'user/profile')?></li>
      <li><?php echo ajax_link('<i class="icon-signout"></i> '.__('Deconnexion'), 'sfGuardAuth/signout')?></li>
    <?php else: ?>
      <li><?php echo ajax_link('<i class="icon-signin"></i> '.__('Connexion'), 'sfGuardAuth/signin')?></li>
      <li><?php echo ajax_link(__('Creer un compte'), 'sfGuardRegister/index')?></li>
    <?php endif; ?>
  </ul>
</div>
