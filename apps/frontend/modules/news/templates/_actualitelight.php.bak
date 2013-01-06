<? use_helper('bb') ?>
    <? foreach ($actualites as $actualite): ?>
    <p style="background: #f3f3f3;padding: 5px;">
	<?=$actualite->getTitle()?><br/>
        <a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>">Lire la suite</a>
    </p>
    <? endforeach; ?>
<p style="padding: 5px;text-align:right;">
    <?=link_to('&gt;&gt; Retrouvez toutes les news', 'news/index')?>
</p>
