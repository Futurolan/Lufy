<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('plateform/index') ?>">Plateforms</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('List')?></li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('plateform/form') ?>"><i class="icon icon-plus-sign"></i> <?php echo __('New')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th></th>
    <th><?php echo __('Name') ?></th>
    <th><?php echo __('Tag') ?></th>
    <th><?php echo __('Constructor') ?></th>
  </tr>
    <?php foreach ($plateforms as $plateform): ?>
  <tr>
    <td><span class="muted">#<?php echo $plateform->getIdPlateform() ?></span></td>
    <td><a href="<?php echo url_for('plateform/view?id_plateform='.$plateform->getIdPlateform()) ?>"><?php echo $plateform->getName() ?></a></td>
    <td><?php echo $plateform->getTag() ?></td>
    <td><?php echo $plateform->getConstructor() ?></td>
  </tr>
    <?php endforeach; ?>
</table>
