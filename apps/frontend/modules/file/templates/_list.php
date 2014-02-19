<?php foreach ($fileCategories as $fileCategory): ?>
  <li><?php echo link_to($fileCategory->getName(), 'file/view?slug='.$fileCategory->getSlug()); ?></li>
<?php endforeach; ?>
