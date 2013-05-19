<?php foreach ($galleries as $gallery): ?>
  <li><?php echo link_to($gallery->getTitle(), 'gallery/view?slug='.$gallery->getSlug()); ?></li>
<?php endforeach; ?>
