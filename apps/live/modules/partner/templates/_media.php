<table width="80%">
<? foreach ($partners as $partner): ?>
    <tr>
    <td style="text-align: center;">
    <a href="<?=url_for('partner/index')?>">
        <?=image_tag('/uploads/partenaires/100/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="partnerLogo"')?>
    </a>
    <br/><br/>
    </td>
    </tr>
<? endforeach; ?>
</table>