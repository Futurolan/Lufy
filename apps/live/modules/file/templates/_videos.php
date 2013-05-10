<?php foreach ($videos as $gallery): ?>
   <ul class="gallery-box">
       <li class="gallery-title"><?php echo link_to($gallery->getName(), 'file/view?slug='.$gallery->getSlug()) ?></li>
       <li class="gallery-content"><?php echo $gallery->getDescription() ?>&nbsp;</li>
   </ul>
<?php endforeach; ?>

<ul style="clear: left;"></ul>
