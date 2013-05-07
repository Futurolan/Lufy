<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<div class="box">
  <div class="title">Actualit&eacute;s</div>
  <div class="content">
    <ul>
    <?php foreach ($pager->getResults() as $actualite): ?>
      <li style="line-height: 25px;"><?php echo format_date($actualite->getPublishOn(), 'dd/MM')?> - <?php echo link_to($actualite->getTitle(), 'news/view?slug='.$actualite->getSlug())?></li>
    <?php endforeach; ?>
    </ul>

    <div class="pager pager-bottom" style="border-top: solid 1px #aaa; text-align: center;">
      <span class="page"><a href="<?php echo url_for('news/index?page='.$pager->getFirstPage())?>"><<</a></span> 
      <?php foreach ($pager->getLinks(10) as $page) echo ($page == ' '.$pager->getPage()) ? ' <span class="current">'.$page : '</span> <span class="page">'.link_to($page, 'news/index?page='.$page).'</span> ' ?> 
      <span class="page"><a href="<?php echo url_for('news/index?page='.$pager->getLastPage())?>">>></a></span>
    </div>
  </div>
</div>
