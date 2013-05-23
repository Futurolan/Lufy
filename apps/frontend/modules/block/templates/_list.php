<?php foreach ($blocks as $block): ?>
    <a href="<?php echo url_for($block->getlink())?>">
        <?php echo image_tag('/uploads/encarts/' . $block->getImage(), array('alt' => $block->getTitle()))?>
    </a>
<?php endforeach; ?>
