<? use_helper('bb') ?>
<div class="box">
    <div class="title"><?=$page->getTitle()?></div>
    <div class="content">
        <?=$page->getContent(ESC_RAW)?>
    </div>
</div>

<? slot('filename'); ?>
        <? echo $page->getTitle(); ?>
<? end_slot(); ?>
