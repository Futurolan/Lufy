<?php $has_results = false ?>

<?php if ($news->count() != 0): ?>
<?php $has_results = true ?>

<div class="subtitle">Actualit&eacute;s</div>
<div>
  <?php foreach ($news as $actualite): ?>
    <?php echo link_to($actualite, 'news/view?slug='.$actualite->getSlug())?><br/>
  <?php endforeach; ?>
</div>
<br/>
<?php endif; ?>


<?php if ($pages->count() != 0): ?>
<?php $has_results = true ?>

<div class="subtitle">Page</div>
<div>
  <?php foreach ($pages as $page): ?>
    <?php echo link_to($page, 'page/view?slug='.$page->getSlug())?><br/>
  <?php endforeach; ?>
</div>
<br/>
<?php endif; ?>


<?php if (!$has_results): ?>
  <?php echo __('Aucun r&eacute;sultat pour cette recherche')?>
<?php endif; ?>

<!--
<div style="text-align: right; font-size: 10px;">
  <a href="#" onclick="$('#result').hide();">Fermer</a>
</div>
-->
