<?php use_helper('bb') ?>
<table cellspacing="0" cellpadding="5">
  <tbody>
    <?php foreach ($actualites as $actualite): ?>
    <tr style="background: #f3f3f3;padding: 5px;">
      <td align="center" valign="middle" width="70"><?php echo image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl())?></td>
      <td valign="top">
        <i style="margin-top: 5px;margin-bottom: 5px;font-size: 12px;">
          <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>" style="color: #111;"><?php echo $actualite->getTitle()?></a>
        </p>
        <i style="color: #222; font-size: 11px;"><?php echo $actualite->getSummary()?> ... </p>
        <i style="margin-bottom: 0px; text-align: right; font-size: 10px; color: grey;">
          <?php echo __('Publie le')?> <?php echo format_date($actualite->getPublishOn(), 'dd/MM/yyy')?> 
          par <?php echo link_to($actualite->getSfGuardUser(), 'user/view?username='.$actualite->getSfGuardUser())?> - 
          <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>#commentaires"><?php include_component('comment', 'nbCommentByNews', array('news_id' => $actualite->getIdNews()));?></a> - 
          <a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>"><?php echo __('Lire la suite')?></a>
        </p>
      </td>
    </tr>
    <tr>
      <td height="10" colspan="2"></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<i style="padding: 5px;text-align:right;">
    <?php echo link_to('&gt;&gt; '.__('Retrouvez toutes les news'), 'news/index')?>
</p>
