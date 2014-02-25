<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('game/index') ?>">Games</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('View')?></li>
  <li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('game/index') ?>"><i class="icon icon-circle-arrow-left"></i> <?php echo __('Back to list')?></a> <span class="divider">|</span></li>
  <li><a href="<?php echo url_for('game/form?id_game='.$game->getIdGame()) ?>"><i class="icon icon-pencil"></i> <?php echo __('Form')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th>Id game:</th>
    <td><?php echo $game->getIdGame() ?></td>
  </tr>
  <tr>
    <th>Game type:</th>
    <td><?php echo $game->getGameTypeId() ?></td>
  </tr>
  <tr>
    <th>Plateform:</th>
    <td><?php echo $game->getPlateformId() ?></td>
  </tr>
  <tr>
    <th>Label:</th>
    <td><?php echo $game->getLabel() ?></td>
  </tr>
  <tr>
    <th>Editor:</th>
    <td><?php echo $game->getEditor() ?></td>
  </tr>
  <tr>
    <th>Year:</th>
    <td><?php echo $game->getYear() ?></td>
  </tr>
  <tr>
    <th>Description:</th>
    <td><?php echo $game->getDescription() ?></td>
  </tr>
  <tr>
    <th>Logourl:</th>
    <td><?php echo $game->getLogourl() ?></td>
  </tr>
</table>

