<ul class="nav nav-list">
  <li class="nav-header"><?php echo $sf_user->getUsername(); ?></li>
  <li><?php echo link_to(__('Mon profil'), 'user/profile'); ?></li>
  <li><?php echo link_to(__('Mes adresses'), 'user/address'); ?></li>
  <li><?php echo link_to(__('Ticket Weezevent'), 'user/weezevent'); ?></li>
  <li><?php echo link_to(__('Licence Masters'), 'user/licenceMasters'); ?></li>
  <li><?php echo link_to(__('Taille de tshirt'), 'user/tshirt'); ?></li>

  <li class="divider"></li>

  <li class="nav-header"><?php echo __('Mon equipe'); ?></li>
  <?php if (count($sf_user->getGuardUser()->getTeamPlayer()) > 0): ?>
    <?php foreach ($sf_user->getGuardUser()->getTeamPlayer() as $player): ?>
      <li><?php echo link_to($player->getTeam()->getName(), 'team/view?slug='.$player->getTeam()->getSlug()); ?></li>
    <?php endforeach; ?>
  <?php else: ?>
      <li style="margin-top: 10px;"><?php echo link_to(__('Creer une equipe'), 'team/new'); ?></li>
  <?php endif; ?>

  <li class="divider"></li>
<!--
  <li class="nav-header"><?php //echo __('Competition'); ?></li>
  <li><?php // echo link_to(__('Inscription'), 'tournament/index'); ?></li>
  <li class="divider"></li>
-->

  <li class="nav-header"><?php echo __('Autre'); ?></li>
  <li><?php include_component('invite', 'nbinvite') ?></li>
  <li><a href="#">Besoin d'aide ?</a></li>
</ul>
