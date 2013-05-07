<?php use_helper('bb') ?>
<div class="box">
    <div class="title"><?php echo $page->getTitle()?></div>
    <div class="content">
        <?php echo $page->getContent(ESC_RAW)?>
    </div>
</div>
