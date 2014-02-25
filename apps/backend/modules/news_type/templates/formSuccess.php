<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('news_type/index') ?>">News types</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('Form')?></li>
  <li>
</ul>


<form class="form-horizontal" action="<?php echo url_for('news_type/'.($form->getObject()->isNew() ? 'form' : 'form').(!$form->getObject()->isNew() ? '?id_news_type='.$form->getObject()->getIdNewsType() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('news_type/index') ?>"><i class="icon icon-circle-arrow-left"></i> <?php echo __('Back to list')?></a> <span class="divider">|</span></li>
  <?php if (!$form->getObject()->isNew()): ?>
    <li><?php echo link_to('<i class="icon icon-remove-sign"></i> '.__('Delete'), 'news_type/delete?id_news_type='.$form->getObject()->getIdNewsType(), array('method' => 'delete', 'confirm' => __('Are you sure ?'))) ?> <span class="divider">|</span></li>
  <?php endif; ?>
  <li><i class="icon icon-ok-sign"></i> <input class="btn-link" type="submit" value="<?php echo __('Save')?>" /></li>
</ul>

<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
    <?php echo $form ?>

</form>

