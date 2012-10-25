<? foreach ($blocks as $block): ?>
    <a href="<?=url_for($block->getlink())?>">
        <?=image_tag('/uploads/encarts/' . $block->getImage(), 'alt="' . $block->getTitle() . '"', 'style="margin: 5px 5px 5px 5px;"')?>
    </a>
<? endforeach; ?>
