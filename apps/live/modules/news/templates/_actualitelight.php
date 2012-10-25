<? use_helper('bb') ?>
    <? foreach ($actualites as $actualite): ?>
    <p style=" font-size: 11px; padding: 5px;margin: 0px;border-bottom: solid 1px #e5e5e5;" class="hoverize">
	<b><?=format_date($actualite->getPublishOn(), 'dd/MM')?></b> - <a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>" style="color: #333;"><?=$actualite->getTitle()?></a>
    </p>
    <? endforeach; ?>
<p style="padding: 5px;text-align:right;">
    <?=link_to('&gt;&gt; Retrouvez toutes les news', 'news/index')?>
</p>
