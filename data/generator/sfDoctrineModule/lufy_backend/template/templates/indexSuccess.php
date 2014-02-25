<ul class="breadcrumb">
  <li><a href="[?php echo url_for('@homepage') ?]"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/index') ?]"><?=sfInflector::humanize($this->getPluralName())?></a> <span class="divider">/</span></li>
  <li class="active">[?= __('List')?]</li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/form') ?]"><i class="icon icon-plus-sign"></i> [?= __('New')?]</a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
<?php foreach ($this->getColumns() as $column): ?>
<?php if ($column->isPrimaryKey()): ?>
    <th></th>
<?php else: ?>
    <th>[?= __('<?=sfInflector::humanize(sfInflector::underscore($column->getPhpName())) ?>') ?]</th>
<?php endif; ?>
<?php endforeach; ?>
  </tr>
    [?php foreach ($<?=$this->getPluralName() ?> as $<?=$this->getSingularName() ?>): ?]
  <tr>
<?php $flag = false; ?>
<?php foreach ($this->getColumns() as $column): ?>
<?php if ($column->isPrimaryKey()): ?>
    <td><span class="muted">#[?php echo $<?php echo $this->getSingularName() ?>->get<?php echo sfInflector::camelize($column->getPhpName()) ?>() ?]</span></td>
<?php else: ?>
<?php if (!$flag): ?>
<?php $flag = true; ?>
    <td><a href="[?php echo url_for('<?php echo $this->getModuleName() ?>/<?php echo isset($this->params['with_show']) && $this->params['with_show'] ? 'view' : 'form' ?>?<?php echo $this->getPrimaryKeyUrlParams() ?>) ?]">[?php echo $<?php echo $this->getSingularName() ?>->get<?php echo sfInflector::camelize($column->getPhpName()) ?>() ?]</a></td>
<?php else: ?>
    <td>[?php echo $<?=$this->getSingularName() ?>->get<?=sfInflector::camelize($column->getPhpName()) ?>() ?]</td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
  </tr>
    [?php endforeach; ?]
</table>
