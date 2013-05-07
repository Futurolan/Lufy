<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<ul>
<?php foreach ($actualites as $actualite): ?>
  <li><span style="font-size: 12px;"><?php echo format_date($actualite->getPublishOn(), 'dd/MM')?> -</span> <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>"><?php echo $actualite->getTitle()?></a></li>
<?php endforeach; ?>
</ul>
