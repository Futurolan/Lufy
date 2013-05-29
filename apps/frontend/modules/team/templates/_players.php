<h3><?php echo __('Composition'); ?></h3>
<table class="table">
<?php foreach ($team->getTeamPlayer() as $player): ?>
<?php echo $team->getIdTeam();?>
<?php echo $player->getSfGuardUser()->getId();?>
    <tr>
      <td><?php echo $player->getSfGuardUser()->getUsername(); ?></td>
      <td><?php echo $player->getSfGuardUser()->getFirstName(); ?> <?php echo substr($player->getSfGuardUser()->getFirstName(), 0, 1); ?>.</td>
      <td>
        <span class="label"><?php if ($player->getIsCaptain() == 1) echo __('Manager'); ?></span>
        <span class="label"><?php if ($player->getIsPlayer() == 1) echo __('Joueur'); ?></span>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
