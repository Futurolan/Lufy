<table class="table" width="100%">
  <tr>
    <?php $i=0; ?>
    <?php foreach ($partners as $partner): ?>
    <?php $i++; ?>
    <td align="center" style="text-align: center;">
      <a href="<?php echo url_for('partner/index')?>">
        <?php echo image_tag('/uploads/partenaires/100/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="partnerLogo"')?>
      </a>
    </td>
    <?php endforeach; ?>
  </tr>
</table>