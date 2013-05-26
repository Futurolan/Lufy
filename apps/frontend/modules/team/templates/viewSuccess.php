<h2><?php echo __('Fiche equipe')?></h2>

<h3><?php echo $team->getName()?></h3>
<table class="table">
  <tr>
    <td align="center" valign="top" rowspan="5" width="200">
      <img src="<?php echo $team->getLogourl(); ?>" width="200" />
    </td>
    <td><?php echo __('Team')?></td>
    <td><?php echo  $team->getName() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Tag')?></td>
    <td><?php echo  $team->getTag() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Cree le')?></td>
    <td><?php echo  $team->getCreatedAt() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Site web')?></td>
    <td><?php echo  $team->getWebsite() ?></td>
  </tr>
  <tr>
    <td><?php echo __('Description')?></td>
    <td><?php echo  $team->getdescription() ?></td>
  </tr>
</table>

<?php if ($isCaptain): ?>
  <?php echo link_to('<i class="icon-pencil"></i> '.__('Modifier'), 'team/edit?slug='.$team->getSlug(), array('class' => 'btn btn-primary')); ?>
  <?php echo link_to('<i class="icon-trash"></i> '.__('Supprimer'), 'team/delete?slug='.$team->getSlug(), array('class' => 'btn btn-danger')); ?>
<?php endif; ?>

<h3><?php echo __('Composition'); ?></h3>
<table class="table">
<?php foreach ($team->getTeamPlayer() as $player): ?>
  <tr>
    <td><?php echo $player->getSfGuardUser()->getUsername(); ?></td>
    <td><?php echo $player->getSfGuardUser()->getFirstName(); ?> <?php echo substr($player->getSfGuardUser()->getFirstName(), 0, 1); ?>.</td>
    <td>
      <?php if ($player->getIsCaptain() == 1) echo __('Manager'); ?>
      <?php if ($player->getIsPlayer() == 1) echo __('Joueur'); ?>
    </td>
  </tr>
<?php endforeach; ?>
</table>

<?php if ($isCaptain): ?>
  <?php echo link_to('<i class="icon-exchange"></i> '.__('Modifier la composition'), 'team/players?slug='.$team->getSlug(), array('class' => 'btn btn-primary')); ?>
<?php endif; ?>
