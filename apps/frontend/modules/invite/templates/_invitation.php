<h2><?php echo __('Nouvelles invitations : ')?></h2>
<?php if (count($invites) == 0): ?>
  <div class="alert alert-info"><?php echo __('Vous n\'avez aucune invitation pour le moment.'); ?></div>
<?php endif; ?>
<ul>
  <?php foreach ($invites as $invite): ?>
    <?php if (is_null($invite->getIsAccepted())):?>
      <li>
        <?php
        echo __('Rejoindre');
        echo ($invite->getTeam()->getName());
        echo (' : ');
        echo link_to(__('Oui'), 'invite/acceptPlayer?id='.$invite->getIdInvite());
        echo (' ');
        echo link_to(__('Non'), 'invite/refusePlayer?id='.$invite->getIdInvite());
        echo '<br/>';?>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>


