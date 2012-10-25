<table class="table" width="100%">
  <tr>
    <? $i=0; ?>
    <? foreach ($partners as $partner): ?>
    <? $i++; ?>
    <td align="center" style="text-align: center;">
      <a href="<?=url_for('partner/index')?>">
        <?=image_tag('/uploads/partenaires/100/' . $partner->getLogourl(), 'alt="' . $partner->getName() . '" class="partnerLogo"')?>
      </a>
    </td>
    <? endforeach; ?>
  </tr>
</table>