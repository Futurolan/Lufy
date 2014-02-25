<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('page_type/index') ?>">Page types</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('View')?></li>
  <li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('page_type/index') ?>"><i class="icon icon-circle-arrow-left"></i> <?php echo __('Back to list')?></a> <span class="divider">|</span></li>
  <li><a href="<?php echo url_for('page_type/form?id_page_type='.$page_type->getIdPageType()) ?>"><i class="icon icon-pencil"></i> <?php echo __('Form')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th>Id page type:</th>
    <td><?php echo $page_type->getIdPageType() ?></td>
  </tr>
  <tr>
    <th>Label:</th>
    <td><?php echo $page_type->getLabel() ?></td>
  </tr>
  <tr>
    <th>Description:</th>
    <td><?php echo $page_type->getDescription() ?></td>
  </tr>
</table>

