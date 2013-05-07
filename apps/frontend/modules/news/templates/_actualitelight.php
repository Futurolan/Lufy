<?php use_helper('bb') ?>
<table width="100%">
    <?php foreach ($actualites as $actualite): ?>
    <tr>
        <td valign=middle">
            <?php echo image_tag('/uploads/news/icones/'.$actualite->getNewsType()->getLogourl(), array('width' => 48))?>
        </td>
        <td valign=middle">
            <span style="font-size: 13px;"><a href="<?php echo url_for('news/view?slug='.$actualite->getSlug())?>"><?php echo $actualite->getTitle()?></a></span>
            <br/>
            <span style="color: #666; font-size: 10px;">
                Le <?php echo format_date($actualite->getPublishOn(), 'dd/MM')?>
                par <?php echo $actualite->getSfGuardUser()?>
            </span>
        </td>
        <td valign=middle">
            <div class="nbComment"><?php echo $actualite->getNbComment()?></div>
        </td>
    </tr>
    <tr height="1">
        <td colspan="3" style="background: #ccc;"></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3" style="padding: 5px;text-align:right;">
            <br/>
            <?php echo link_to('&gt;&gt; Retrouvez toutes les news', 'news/index')?>
        </td>
</table>
