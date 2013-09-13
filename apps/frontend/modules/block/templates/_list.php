<div class="row-fluid" style="margin-top: 30px;">
  <?php foreach ($blocks as $block): ?>
    <div class="span4">
      <a href="<?php echo url_for($block->getlink())?>">
        <?php echo image_tag('/uploads/encarts/' . $block->getImage(), array('alt' => $block->getTitle()))?>
      </a>
    </div>
  <?php endforeach; ?>
</div>
