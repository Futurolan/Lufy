<?php use_helper('bb') ?>

<h2>Les news</h2>

<table>
    <?php foreach ($pager->getResults() as $actualite): ?>
    <tr>
      <td width="70" valign="top"><?php echo image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl())?></td>
      <td valign="top">
        <h4><?php echo $actualite->getTitle()?></h4>
        <span style="margin-bottom: 0px; text-align: right; font-size: 10px; color: grey;">
          Publi&eacute; le <?php echo format_date($actualite->getPublishOn(), 'dd/MM/yyy')?> -
          <?php include_component('comment', 'nbCommentByNews', array('news_id' => $actualite->getIdNews()));?> -
          <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>">Lire la suite</a>
        </span>
      </td>
    </tr>
    <tr>
      <td height="30" colspan="2"></td>
    </tr>
    <?php endforeach; ?>
</table>

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
