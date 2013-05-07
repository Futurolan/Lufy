<?php use_helper('bb') ?>
    <?php foreach ($actualites as $actualite): ?>
    <i style=" font-size: 11px; padding: 5px;margin: 0px;border-bottom: solid 1px #e5e5e5;" class="hoverize">
	<b><?php echo format_date($actualite->getPublishOn(), 'dd/MM')?></b> - <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>" style="color: #333;"><?php echo $actualite->getTitle()?></a>
    </p>
    <?php endforeach; ?>
<i style="padding: 5px;text-align:right;">
    <?php echo link_to('&gt;&gt; Retrouvez toutes les news', 'news/index')?>
</p>
