<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('game_type/index') ?>">Game types</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('List')?></li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('game_type/form') ?>"><i class="icon icon-plus-sign"></i> <?php echo __('New')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th></th>
    <th><?php echo __('Label') ?></th>
  </tr>
    <?php foreach ($game_types as $game_type): ?>
  <tr>
    <td><span class="muted">#<?php echo $game_type->getIdGameType() ?></span></td>
    <td><a href="<?php echo url_for('game_type/view?id_game_type='.$game_type->getIdGameType()) ?>"><?php echo $game_type->getLabel() ?></a></td>
  </tr>
    <?php endforeach; ?>
</table>
