<?php use_helper('bb') ?>
    <?php foreach ($actualites as $actualite): ?>
    <i style="background: #f3f3f3;padding: 5px;">
	<?php echo $actualite->getTitle()?><br/>
        <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>">Lire la suite</a>
    </p>
    <?php endforeach; ?>
<i style="padding: 5px;text-align:right;">
    <?php echo link_to('&gt;&gt; Retrouvez toutes les news', 'news/index')?>
</p>
