<? use_helper('bb') ?>
<table cellspacing="0" cellpadding="5">
  <tbody>
    <? foreach ($actualites as $actualite): ?>
    <tr style="background: #f3f3f3;padding: 5px;">
      <td align="center" valign="middle" width="70"><?=image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl())?></td>
      <td valign="top">
        <p style="margin-top: 5px;margin-bottom: 5px;font-size: 12px;"><?=$actualite->getTitle()?></p>
        <p style="margin-bottom: 0px; text-align: right; font-size: 10px; color: grey;">
          Publi&eacute; le <?=format_date($actualite->getPublishOn(), 'dd/MM/yyy')?> par <?=$actualite->getSfGuardUser()?> 
          <a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>">Lire la suite</a>
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
    <?=link_to('&gt;&gt; Retrouvez toutes les news', 'news/index')?>
</p>
