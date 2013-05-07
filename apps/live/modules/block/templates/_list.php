<?php foreach ($blocks as $block): ?>
    <a href="<?php echo url_for($block->getlink())?>">
        <?php echo image_tag('/uploads/encarts/' . $block->getImage(), 'alt="' . $block->getTitle() . '"', 'style="margin: 5px 5px 5px 5px;"')?>
    </a>
<?php endforeach; ?>
