<? foreach ($videos as $gallery): ?>
   <ul class="gallery-box">
       <li class="gallery-title"><?=link_to($gallery->getName(), 'file/view?slug='.$gallery->getSlug()) ?></li>
       <li class="gallery-content" style="font-size: 12px; font-style: italic;"><?php echo $gallery->getDescription() ?>&nbsp;</li>
   </ul>
<? endforeach; ?>

<ul style="clear: left;"></ul>
