<?php echo link_to('<i class="icon-pencil"></i> '.__('Modifier'), 'team/edit?slug='.$team->getSlug(), array('class' => 'btn btn-primary')); ?>
<?php echo ' ';?>
<?php echo link_to('<i class="icon-trash"></i> '.__('Supprimer'), 'team/delete?slug='.$team->getSlug(), array('class' => 'btn btn-danger')); ?>
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
      <td>
        <div class="btn-group">
         <a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> <?php echo __('Definir comme') ?> <span class="caret"></span></a>
         <ul class="dropdown-menu">
           <li><?php echo link_to(__('Joueur'), 'team/setPlayer?team_id='.$team->getIdTeam().'&user_id='.$player->getSfGuardUser()->getId()); ?></li>
           <li><?php echo link_to(__('Manager'), 'team/setCaptain?team_id='.$team->getIdTeam().'&user_id='.$player->getSfGuardUser()->getId()); ?></li>
           <!--<li><?php //echo link_to(__('Manager et joueur'), 'user/setPlayerAndCaptain?id='/*.$address->getId()*/); ?></li>-->
         </ul>
        </div>
      </td>
      <td><?php echo link_to('<i class="icon-trash" ></i> '.__('Expulser'), 'team/deleteMember?team_id='.$team->getIdTeam().'&user_id='.$player->getSfGuardUser()->getId(), array('class' => 'btn btn-danger btn-mini')); ?> <br/></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php echo link_to('<i class="icon-plus"></i> '.__('Inviter un joueur'), 'team/searchPlayers?slug='.$team->getSlug(), array('class' => 'btn btn-success')); ?>