<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('news_type/index') ?>">News types</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('View')?></li>
  <li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('news_type/index') ?>"><i class="icon icon-circle-arrow-left"></i> <?php echo __('Back to list')?></a> <span class="divider">|</span></li>
  <li><a href="<?php echo url_for('news_type/form?id_news_type='.$news_type->getIdNewsType()) ?>"><i class="icon icon-pencil"></i> <?php echo __('Form')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th>Id news type:</th>
    <td><?php echo $news_type->getIdNewsType() ?></td>
  </tr>
  <tr>
    <th>Label:</th>
    <td><?php echo $news_type->getLabel() ?></td>
  </tr>
  <tr>
    <th>Description:</th>
    <td><?php echo $news_type->getDescription() ?></td>
  </tr>
  <tr>
    <th>Logourl:</th>
    <td><?php echo $news_type->getLogourl() ?></td>
  </tr>
  <tr>
    <th>Is special:</th>
    <td><?php echo $news_type->getIsSpecial() ?></td>
  </tr>
</table>

