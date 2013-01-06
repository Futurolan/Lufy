<? $has_results = false ?>

<? if ($news->count() != 0): ?>
<? $has_results = true ?>

<div class="subtitle">Actualit&eacute;s</div>
<div>
  <? foreach ($news as $actualite): ?>
    <?=link_to($actualite, 'news/view?slug='.$actualite->getSlug())?><br/>
  <? endforeach; ?>
</div>
<br/>
<? endif; ?>


<? if ($pages->count() != 0): ?>
<? $has_results = true ?>

<div class="subtitle">Page</div>
<div>
  <? foreach ($pages as $page): ?>
    <?=link_to($page, 'page/view?slug='.$page->getSlug())?><br/>
  <? endforeach; ?>
</div>
<br/>
<? endif; ?>


<? if (!$has_results): ?>
  <?=__('Aucun r&eacute;sultat pour cette recherche')?>
<? endif; ?>

<!--
<div style="text-align: right; font-size: 10px;">
  <a href="#" onclick="$('#result').hide();">Fermer</a>
</div>
-->
