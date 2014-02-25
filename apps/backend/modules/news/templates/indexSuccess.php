<h2>Actualit&eacute;s</h2>

 <a href="<?php echo url_for('news/new') ?>" class="btn">Ajouter une news</a>
<?=link_to('G&eacute;rer les cat&eacute;gories', 'news_type/index', array('class' => 'btn'))?>

<table class="table">
  <thead>
    <tr>
      <th></th>
      <th>Titre</th>
      <th>Publi&eacute; le</th>
      <th>Cat&eacute;gorie</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $news): ?>
    <tr>
      <td id="news_status_<?=$news->getIdNews()?>">
        <? if ($news->getStatus() == 1): ?>
          <? $img = '/css/img/backend/8green.png'; ?>
        <? else: ?>
          <? $img = '/css/img/backend/8red.png'; ?>
        <? endif; ?>
        <a style="cursor: pointer;" onclick="news_switchStatus('<?=$news->getIdNews()?>');"><?=image_tag($img)?></a>
      <td>
	<?php
        if (substr($news->getSlug(), -3, 3) == '-en') {
            $lang = 'GB';
        }
        else {
            $lang = 'FR';
        }
        echo image_tag('/css/img/flag/'.$lang.'.png');
         ?>
	<?=link_to($news->getTitle(), 'news/edit?id_news='.$news->getIdNews())?><br/>
	<i style="font-size: 11px; color:#666;">Definir cette news comme etant en 
	<? if ($lang == 'GB') {
	    echo link_to('francais', 'news/set?id_news='.$news->getIdNews().'&lang=fr', array('method' => 'delete', 'confirm' => 'Etes vous sur de vouloir changer la langue ?'));
	}
	else {
	    echo link_to('anglais', 'news/set?id_news='.$news->getIdNews().'&lang=en', array('method' => 'delete', 'confirm' => 'Etes vous sur de vouloir changer la langue ?'));
	}
	?>
	</a>
      </td>
      <td style="font-size: 11px;"><?php echo date('d/m/Y', strtotime($news->getPublishOn())) ?></td>
      <td style="font-size: 11px;"><?php echo $news->getNewsType() ?></td>
      <td style="font-size: 11px;">
       <?=ajax_component('Apercu', 'news/preview?id_news='.$news->getIdNews(), array('class' => 'btn btn-default small','width' => 760))?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="pager pager-bottom">
    Page :
    <span class="page"><?=link_to('Premi&egrave;re', 'news/index?page='.$pager->getFirstPage())?></span>
    <? foreach ($pager->getLinks(10) as $page) echo ($page == ' '.$pager->getPage()) ? ' <span class="current">'.$page : '</span> <span class="page">'.link_to($page, 'news/index?page='.$page)?>
    <span class="page"><?=link_to('Derni&egrave;re', 'news/index?page='.$pager->getLastPage())?></span>
</div>

<script>
function news_switchStatus(id) {
  $.get('<?=url_for('news/switchStatus')?>',
    { 'id_news': id },
    function success(data) {
      if ($('#news_status_'+id+' a img').attr('src') == '/css/img/backend/8green.png') {
        $('#news_status_'+id+' a img').attr('src', '/css/img/backend/8red.png');
      }
      else {
        $('#news_status_'+id+' a img').attr('src', '/css/img/backend/8green.png');
      }
    });
}
</script>

