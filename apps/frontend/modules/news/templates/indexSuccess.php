<?php use_helper('bb') ?>

<h2><?=__('News')?></h2>

<?php foreach ($pager->getResults() as $actualite): ?>
  <div class="news">
    <div class="news-date">
      <div class="news-date-day-month"><?php echo format_date($actualite->getPublishOn(), 'dd/MM')?></div>
      <div class="news-date-year"><?php echo format_date($actualite->getPublishOn(), 'yyy')?></div>
    </div>
    <div class="news-icone">
      <img src="http://www.gamers-assembly.net/uploads/news/icones/<?=$actualite->getNewsType()->getLogourl()?>" />
      <?php echo image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl())?>
    </div>
    <div class="news-title">
      <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>">
        <?php echo $actualite->getTitle()?>
      </a>
    </div>
  </div>
<?php endforeach; ?>

<style>
.news {
  clear: left;
}
.news-date, .news-icone, .news-title {
  float: left;
}
.news-icone, .news-title {
  line-height: 50px;
}
.news-date {
  margin: 5px 5px 15px 5px;
  padding: 5px;
  text-align: center;
  background-color: #eee;
  border: solid 1px #ddd;
}
.news-date-day-month {
  margin: -5px;
  padding: 5px;
  width: 35px;
  line-height: 18px;
}
.news-date-year {
  margin: 2px -5px -5px -5px;
  padding: 0px 5px 0px 5px;
  width: 35px;
  font-size: 11px;
  font-weight: bold;
  line-height: 18px;
  letter-spacing: 1px;
  text-align: center;
  color: #fff;
  background-color: #333;
}
.news-icone {
  margin: 0px 10px 0px 10px;
}
.news-icone img {
  width: 50px;
  height: 50px;
}
.news-title {
  font-size: 16px;
}
</style>

<br/><br/>
<br/><br/>

<div class="pagination" style="text-align: center;">
  <ul>
    <?php if ($sf_request->getParameter('page') == $pager->getFirstPage()): ?>
      <li class="disabled"><a href="<?php echo url_for('news/index?page='.$pager->getFirstPage())?>"><i class="icon-double-angle-left"></i></a></li> 
    <?php else: ?>
      <li><a href="<?php echo url_for('news/index?page='.$pager->getFirstPage())?>"><i class="icon-double-angle-left"></i></a></li> 
    <?php endif; ?>
    <?php foreach ($pager->getLinks(10) as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <li class="active"><a href="#"><?php echo $page; ?></a></li>
      <?php else: ?>
        <li><?php echo link_to($page, 'news/index?page='.$page); ?></li>
      <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($sf_request->getParameter('page') == $pager->getLastPage()): ?>
      <li class="disabled"><a href="<?php echo url_for('news/index?page='.$pager->getLastPage())?>"><i class="icon-double-angle-right"></i></a></li>
    <?php else: ?>
      <li><a href="<?php echo url_for('news/index?page='.$pager->getLastPage())?>"><i class="icon-double-angle-right"></i></a></li>
    <?php endif; ?>
  </ul>
</div>
