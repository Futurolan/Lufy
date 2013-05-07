<?php use_helper('bb') ?>

<div class="box">
    <div class="title">Les news</div>
    <div class="content">

    <table>
    <tbody>
        <?php foreach ($pager->getResults() as $actualite): ?>
            <tr>
                <td width="70" valign="top"><?php echo image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl())?></td>
                <td valign="top">
                    <h4><?php echo $actualite->getTitle()?></h4>
        <i style="color: #222; font-size: 12px;"><?php echo $actualite->getSummary()?> ... </p>
        <i style="margin-bottom: 0px; text-align: right; font-size: 10px; color: grey;">
          Publi&eacute; le <?php echo format_date($actualite->getPublishOn(), 'dd/MM/yyy')?> par <?php echo link_to($actualite->getSfGuardUser(), 'user/view?username='.$actualite->getSfGuardUser())?> -
          <?php include_component('comment', 'nbCommentByNews', array('news_id' => $actualite->getIdNews()));?> -
          <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>">Lire la suite</a>
        </p>
                </td>
            </tr>
            <tr>
                <td height="30" colspan="2"></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<div class="pager pager-bottom">
    Page : 
    <span class="page"><a href="<?php echo url_for('news/index?page='.$pager->getFirstPage())?>">Premi&egrave;re</a></span> 
    <?php foreach ($pager->getLinks(10) as $page) echo ($page == ' '.$pager->getPage()) ? ' <span class="current">'.$page : '</span> <span class="page">'.link_to($page, 'news/index?page='.$page).'</span> ' ?> 
    <span class="page"><a href="<?php echo url_for('news/index?page='.$pager->getLastPage())?>">Derni&egrave;re</a></span>
</div>
</div>
</div>
