<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('event/index') ?>">Events</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('List')?></li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('event/form') ?>"><i class="icon icon-plus-sign"></i> <?php echo __('New')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th></th>
    <th><?php echo __('Weezevent') ?></th>
    <th><?php echo __('Name') ?></th>
    <th><?php echo __('Description') ?></th>
    <th><?php echo __('Image') ?></th>
    <th><?php echo __('Start at') ?></th>
    <th><?php echo __('End at') ?></th>
    <th><?php echo __('Start registration at') ?></th>
    <th><?php echo __('End registration at') ?></th>
    <th><?php echo __('Address') ?></th>
    <th><?php echo __('Map url') ?></th>
    <th><?php echo __('Slug') ?></th>
  </tr>
    <?php foreach ($events as $event): ?>
  <tr>
    <td><span class="muted">#<?php echo $event->getIdEvent() ?></span></td>
    <td><a href="<?php echo url_for('event/view?id_event='.$event->getIdEvent()) ?>"><?php echo $event->getWeezeventId() ?></a></td>
    <td><?php echo $event->getName() ?></td>
    <td><?php echo $event->getDescription() ?></td>
    <td><?php echo $event->getImage() ?></td>
    <td><?php echo $event->getStartAt() ?></td>
    <td><?php echo $event->getEndAt() ?></td>
    <td><?php echo $event->getStartRegistrationAt() ?></td>
    <td><?php echo $event->getEndRegistrationAt() ?></td>
    <td><?php echo $event->getAddress() ?></td>
    <td><?php echo $event->getMapUrl() ?></td>
    <td><?php echo $event->getSlug() ?></td>
  </tr>
    <?php endforeach; ?>
</table>
