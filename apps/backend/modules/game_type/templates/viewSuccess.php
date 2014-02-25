<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('game_type/index') ?>">Game types</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('View')?></li>
  <li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('game_type/index') ?>"><i class="icon icon-circle-arrow-left"></i> <?php echo __('Back to list')?></a> <span class="divider">|</span></li>
  <li><a href="<?php echo url_for('game_type/form?id_game_type='.$game_type->getIdGameType()) ?>"><i class="icon icon-pencil"></i> <?php echo __('Form')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th>Id game type:</th>
    <td><?php echo $game_type->getIdGameType() ?></td>
  </tr>
  <tr>
    <th>Label:</th>
    <td><?php echo $game_type->getLabel() ?></td>
  </tr>
</table>

