<? use_helper('bb') ?>
<table cellspacing="0" cellpadding="5">
  <tbody>
    <? foreach ($actualites as $actualite): ?>
    <tr style="background: #f3f3f3;padding: 5px;">
      <td align="center" valign="middle" width="70"><?=image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl())?></td>
      <td valign="top">
        <p style="margin-top: 5px;margin-bottom: 5px;font-size: 12px;">
          <a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>" style="color: #111;"><?=$actualite->getTitle()?></a>
        </p>
        <p style="color: #222; font-size: 11px;"><?=$actualite->getSummary()?> ... </p>
        <p style="margin-bottom: 0px; text-align: right; font-size: 10px; color: grey;">
          <?=__('Publie le')?> <?=format_date($actualite->getPublishOn(), 'dd/MM/yyy')?> 
          par <?=link_to($actualite->getSfGuardUser(), 'user/view?username='.$actualite->getSfGuardUser())?> - 
          <a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>#commentaires"><?php include_component('comment', 'nbCommentByNews', array('news_id' => $actualite->getIdNews()));?></a> - 
          <a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>"><?=__('Lire la suite')?></a>
        </p>
      </td>
    </tr>
    <tr>
      <td height="10" colspan="2"></td>
    </tr>
    <? endforeach; ?>
  </tbody>
</table>
<p style="padding: 5px;text-align:right;">
    <?=link_to('&gt;&gt; '.__('Retrouvez toutes les news'), 'news/index')?>
</p>
