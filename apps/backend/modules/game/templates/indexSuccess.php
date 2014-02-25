<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('game/index') ?>">Games</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('List')?></li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('game/form') ?>"><i class="icon icon-plus-sign"></i> <?php echo __('New')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th></th>
    <th><?php echo __('Label') ?></th>
    <th><?php echo __('Game type') ?></th>
    <th><?php echo __('Plateform') ?></th>
    <th><?php echo __('Logourl') ?></th>
  </tr>
    <?php foreach ($games as $game): ?>
  <tr>
    <td><span class="muted">#<?php echo $game->getIdGame() ?></span></td>
    <td><?php echo $game->getLabel() ?></td>
    <td><a href="<?php echo url_for('game/view?id_game='.$game->getIdGame()) ?>"><?php echo $game->getGameType() ?></a></td>
    <td><?php echo $game->getPlateform() ?></td>
    <td><?php echo $game->getLogourl() ?></td>
  </tr>
    <?php endforeach; ?>
</table>
