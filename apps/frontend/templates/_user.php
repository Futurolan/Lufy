<ul class="nav nav-list">
  <li class="nav-header"><?php echo $sf_user->getUsername(); ?></li>
  <li><?php echo link_to(__('Mon profil'), 'user/profile'); ?></li>
  <li><?php echo link_to(__('Licence Masters'), 'user/licenceMasters'); ?></li>
  <li><?php echo link_to(__('Mes adresses'), 'user/address'); ?></li>
  <li><?php echo link_to(__('Taille de tshirt'), 'user/tshirt'); ?></li>

  <li class="divider"></li>

  <li class="nav-header"><?php echo __('Competition'); ?></li>
  <li><?php echo link_to(__('Mon equipe'), 'team/index'); ?></li>
  <li><?php echo link_to(__('Inscription'), 'tournament/index'); ?></li>

  <li class="divider"></li>

  <li class="nav-header"><?php echo __('Autre'); ?></li>
  <li><a href="#">Mes invitations</a></li>
  <li><a href="#">Besoin d'aide ?</a></li>
</ul>