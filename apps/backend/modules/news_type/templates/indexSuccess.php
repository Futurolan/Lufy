<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('news_type/index') ?>">News types</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('List')?></li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('news_type/form') ?>"><i class="icon icon-plus-sign"></i> <?php echo __('New')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th></th>
    <th>Label</th>
    <th>Description</th>
    <th>Logourl</th>
    <th>Is special</th>
  </tr>
    <?php foreach ($news_types as $news_type): ?>
  <tr>
    <td><span class="muted">#<?php echo $news_type->getIdNewsType() ?></span></td>
    <td><a href="<?php echo url_for('news_type/view?id_news_type='.$news_type->getIdNewsType()) ?>"><?php echo $news_type->getLabel() ?></a></td>
    <td><?php echo $news_type->getDescription() ?></td>
    <td><?php echo $news_type->getLogourl() ?></td>
    <td><?php echo $news_type->getIsSpecial() ?></td>
  </tr>
    <?php endforeach; ?>
</table>
