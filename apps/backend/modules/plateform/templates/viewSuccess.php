<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('plateform/index') ?>">Plateforms</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('View')?></li>
  <li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('plateform/index') ?>"><i class="icon icon-circle-arrow-left"></i> <?php echo __('Back to list')?></a> <span class="divider">|</span></li>
  <li><a href="<?php echo url_for('plateform/form?id_plateform='.$plateform->getIdPlateform()) ?>"><i class="icon icon-pencil"></i> <?php echo __('Form')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th>Id plateform:</th>
    <td><?php echo $plateform->getIdPlateform() ?></td>
  </tr>
  <tr>
    <th>Name:</th>
    <td><?php echo $plateform->getName() ?></td>
  </tr>
  <tr>
    <th>Tag:</th>
    <td><?php echo $plateform->getTag() ?></td>
  </tr>
  <tr>
    <th>Constructor:</th>
    <td><?php echo $plateform->getConstructor() ?></td>
  </tr>
</table>

