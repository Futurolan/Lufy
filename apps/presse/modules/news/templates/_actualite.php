<? use_helper('bb') ?>
<? use_helper('Date') ?>

<ul>
<? foreach ($actualites as $actualite): ?>
  <li><span style="font-size: 12px;"><?=format_date($actualite->getPublishOn(), 'dd/MM')?> -</span> <a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>"><?=$actualite->getTitle()?></a></li>
<? endforeach; ?>
</ul>
