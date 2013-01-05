<? use_helper('bb') ?>
<table width="100%">
    <? foreach ($actualites as $actualite): ?>
    <tr>
        <td valign=middle">
            <?=image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl(), array('width' => 48))?>
        </td>
        <td valign=middle">
            <span style="font-size: 13px;"><a href="<?=url_for('news/view?slug='.$actualite->getSlug())?>"><?=$actualite->getTitle()?></a></span>
            <br/>
            <span style="color: #666; font-size: 10px;">
                Le <?=format_date($actualite->getPublishOn(), 'dd/MM')?>
                par <?=$actualite->getSfGuardUser()?>
            </span>
        </td>
        <td valign=middle">
            <div class="nbComment"><?=$actualite->getNbComment()?></div>
        </td>
    </tr>
    <tr height="1">
        <td colspan="3" style="background: #ccc;"></td>
    </tr>
    <? endforeach; ?>
    <tr>
        <td colspan="3" style="padding: 5px;text-align:right;">
            <br/>
            <?=link_to('&gt;&gt; Retrouvez toutes les news', 'news/index')?>
        </td>
</table>
