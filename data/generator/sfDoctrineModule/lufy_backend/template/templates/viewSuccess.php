<ul class="breadcrumb">
  <li><a href="[?php echo url_for('@homepage') ?]"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/index') ?]"><?=sfInflector::humanize($this->getPluralName())?></a> <span class="divider">/</span></li>
  <li class="active">[?= __('View')?]</li>
  <li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/index') ?]"><i class="icon icon-circle-arrow-left"></i> [?= __('Back to list')?]</a> <span class="divider">|</span></li>
  <li><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/form?<?php echo $this->getPrimaryKeyUrlParams() ?>) ?]"><i class="icon icon-pencil"></i> [?= __('Form')?]</a></li>
</ul>


<table class="table table-striped table-hover">
<?php foreach ($this->getColumns() as $column): ?>
  <tr>
    <th><?php echo sfInflector::humanize(sfInflector::underscore($column->getPhpName())) ?>:</th>
    <td>[?php echo $<?php echo $this->getSingularName() ?>->get<?php echo sfInflector::camelize($column->getPhpName()) ?>() ?]</td>
  </tr>
<?php endforeach; ?>
</table>

