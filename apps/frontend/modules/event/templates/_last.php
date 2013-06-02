<?php if ($event): ?>
  <li><?php echo link_to($event->getName(), 'event/view?slug='.$event->getSlug())?></li>
<?php endif; ?>
