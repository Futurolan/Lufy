<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('page_type/index') ?>">Page types</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('List')?></li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('page_type/form') ?>"><i class="icon icon-plus-sign"></i> <?php echo __('New')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th></th>
    <th><?php echo __('Label') ?></th>
    <th><?php echo __('Description') ?></th>
  </tr>
    <?php foreach ($page_types as $page_type): ?>
  <tr>
    <td><span class="muted">#<?php echo $page_type->getIdPageType() ?></span></td>
    <td><a href="<?php echo url_for('page_type/view?id_page_type='.$page_type->getIdPageType()) ?>"><?php echo $page_type->getLabel() ?></a></td>
    <td><?php echo $page_type->getDescription() ?></td>
  </tr>
    <?php endforeach; ?>
</table>
