<table width="80%">
<?php foreach ($partners as $partner): ?>
    <tr>
    <td style="text-align: center;">
    <a href="<?php echo url_for('partner/index')?>">
        <?php echo image_tag('/uploads/partenaires/100/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="partnerLogo"')?>
    </a>
    <br/><br/>
    </td>
    </tr>
<?php endforeach; ?>
</table>