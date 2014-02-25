<ul class="breadcrumb">
  <li><a href="<?php echo url_for('@homepage') ?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
  <li><a href="<?php echo url_for('event/index') ?>">Events</a> <span class="divider">/</span></li>
  <li class="active"><?php echo __('View')?></li>
  <li>
</ul>

<ul class="breadcrumb subbreadcrumb">
  <li><a href="<?php echo url_for('event/index') ?>"><i class="icon icon-circle-arrow-left"></i> <?php echo __('Back to list')?></a> <span class="divider">|</span></li>
  <li><a href="<?php echo url_for('event/form?id_event='.$event->getIdEvent()) ?>"><i class="icon icon-pencil"></i> <?php echo __('Form')?></a></li>
</ul>


<table class="table table-striped table-hover">
  <tr>
    <th>Id event:</th>
    <td><?php echo $event->getIdEvent() ?></td>
  </tr>
  <tr>
    <th>Weezevent:</th>
    <td><?php echo $event->getWeezeventId() ?></td>
  </tr>
  <tr>
    <th>Name:</th>
    <td><?php echo $event->getName() ?></td>
  </tr>
  <tr>
    <th>Description:</th>
    <td><?php echo $event->getDescription() ?></td>
  </tr>
  <tr>
    <th>Image:</th>
    <td><?php echo $event->getImage() ?></td>
  </tr>
  <tr>
    <th>Start at:</th>
    <td><?php echo $event->getStartAt() ?></td>
  </tr>
  <tr>
    <th>End at:</th>
    <td><?php echo $event->getEndAt() ?></td>
  </tr>
  <tr>
    <th>Start registration at:</th>
    <td><?php echo $event->getStartRegistrationAt() ?></td>
  </tr>
  <tr>
    <th>End registration at:</th>
    <td><?php echo $event->getEndRegistrationAt() ?></td>
  </tr>
  <tr>
    <th>Address:</th>
    <td><?php echo $event->getAddress() ?></td>
  </tr>
  <tr>
    <th>Map url:</th>
    <td><?php echo $event->getMapUrl() ?></td>
  </tr>
  <tr>
    <th>Slug:</th>
    <td><?php echo $event->getSlug() ?></td>
  </tr>
</table>

