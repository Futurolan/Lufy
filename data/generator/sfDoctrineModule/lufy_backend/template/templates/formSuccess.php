[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<ul class="breadcrumb">
  <li><a href="[?php echo url_for('@homepage') ?]"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/index') ?]"><?=sfInflector::humanize($this->getPluralName())?></a> <span class="divider">/</span></li>
  <li class="active">[?= __('Form')?]</li>
  <li>
</ul>


<?php $form = $this->getFormObject() ?>
<form class="form-horizontal" action="[?php echo url_for('<?php echo $this->getModuleName() ?>/'.($form->getObject()->isNew() ? 'form' : 'form').(!$form->getObject()->isNew() ? '?<?php echo $this->getPrimaryKeyUrlParams('$form->getObject()', true) ?> : '')) ?]" method="post" [?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?]>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/index') ?]"><i class="icon icon-circle-arrow-left"></i> [?= __('Back to list')?]</a> <span class="divider">|</span></li>
  [?php if (!$form->getObject()->isNew()): ?]
    <li>[?php echo link_to('<i class="icon icon-remove-sign"></i> '.__('Delete'), '<?php echo $this->getModuleName() ?>/delete?<?php echo $this->getPrimaryKeyUrlParams('$form->getObject()', true) ?>, array('method' => 'delete', 'confirm' => __('Are you sure ?'))) ?] <span class="divider">|</span></li>
  [?php endif; ?]
  <li><i class="icon icon-ok-sign"></i> <input class="btn-link" type="submit" value="[?= __('Save')?]" /></li>
</ul>

[?php if (!$form->getObject()->isNew()): ?]
<input type="hidden" name="sf_method" value="put" />
[?php endif; ?]
<?php if (isset($this->params['non_verbose_templates']) && $this->params['non_verbose_templates']): ?>
    [?php echo $form ?]
<?php else: ?>
  <table>
    [?php echo $form->renderGlobalErrors() ?]
<?php foreach ($form as $name => $field): if ($field->isHidden()) continue ?>
    <tr>
      <th>[?php echo $form['<?php echo $name ?>']->renderLabel() ?]</th>
      <td>
        [?php echo $form['<?php echo $name ?>']->renderError() ?]
        [?php echo $form['<?php echo $name ?>'] ?]
      </td>
    </tr>
<?php endforeach; ?>
  </table>
<?php endif; ?>

<?php if (!isset($this->params['non_verbose_templates']) || !$this->params['non_verbose_templates']): ?>
  [?php echo $form->renderHiddenFields(false) ?]
<?php endif; ?>
</form>

