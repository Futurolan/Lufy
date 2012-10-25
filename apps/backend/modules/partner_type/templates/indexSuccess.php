<script type="text/javascript">
	$(function() {
		$("#jquery-ui-partner-type").sortable({
            update : function(event,ui){
                var list = ui.item.parent("ul");
                var pos = 0;
                $(list.find("li")).each(function(){
                    pos++;
                    $(this).find('input.positionInput').val(pos);
                });
            }
        });
		$("#jquery-ui-partner-type").disableSelection();
	});
</script>

<h2>Cat&eacute;gorie des partenaires</h2>

<form method="POST" action="<?=url_for('partner_type/updatePosition')?>">

<input type="submit" value="Enregistrer les changements"  class="button save"/>
<a href="<?php echo url_for('partner_type/new') ?>" class="button add">Ajouter une cat&eacute;gorie</a>
<a href="<?php echo url_for('partner/index') ?>" class="button">Retour aux partenaires</a>

<ul id="jquery-ui-partner-type">
  <? $i= 0; foreach ($partners_types as $partner_type): $i++; ?>
    <?php
    if ($partner_type->getStatus() == '0'): ?>
        <li class="inactive">
    <? else: ?>
        <li>
    <? endif; ?>
        <table width="800px;">
            <tr height="25">
                <td width="20px" align="center" valign="center">
                    <input type="hidden" name="partner_type[<?=$i?>][id]" value="<?=$partner_type->getIdPartnerType()?>" />
                    <input type="hidden" class="positionInput" name="partner_type[<?=$i?>][position]" value="<?=$partner_type->getPosition()?>" /> 
                </td>
                <td width="490px">
                    <span style="font-size: 14px;"><?=strtoupper($partner_type->getName())?></span>
                </td>
                <td width="150px">
                    <?php echo ajax_link('Modifier','partner_type/edit?id_partner_type='.$partner_type->getIdPartnerType()) ?>
                    <?php echo ajax_link('Visible/Cach&eacute;','partner_type/setStatus?id_partner_type='.$partner_type->getIdPartnerType()) ?> 
                </td>
            </tr>
        </table>
      
       
    </li>
  <? endforeach; ?>
</ul>
</form>
