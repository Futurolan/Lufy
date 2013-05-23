<script type="text/javascript">
	$(function() {
		$("#jquery-ui-partner").sortable({
            update : function(event,ui){
                var list = ui.item.parent("ul");
                var pos = 0;
                $(list.find("li")).each(function(){
                    pos++;
                    $(this).find('input.positionInput').val(pos);
                });
            }
        });
		$("#jquery-ui-partner").disableSelection();
	});
</script>

<h2>Partenaires</h2>

<form method="POST" action="<?=url_for('partner/updatePosition')?>">

<input type="submit" value="Enregistrer les changements"  class="button save"/>
<a href="<?php echo url_for('partner/new') ?>" class="button add">Ajouter un partenaire</a>
<a href="<?php echo url_for('partner_type/index') ?>" class="button">G&eacute;rer les cat&eacute;gories</a>

<ul id="jquery-ui-partner">
  <? $i= 0; foreach ($partners as $partner): $i++; ?>
    <?php
    if ($partner->getStatus() == '0'): ?>
        <li class="inactive" style="width: 260px; float: left; margin-right: 10px; height: 65px;">
    <? else: ?>
        <li style="width: 260px; float: left; margin-right: 10px; height: 65px;">
    <? endif; ?>
        <table>
            <tr>
                <td align="center" valign="center" width="80px" height="65px">
                    <?=image_tag('/uploads/partenaires/100/'.$partner->getLogourl(), 'style="max-width: 70px; max-height: 50px;" alt="'.$partner->getName().'"')?>
                    <input type="hidden" name="partner[<?=$i?>][id]" value="<?=$partner->getIdPartner()?>" />
                    <input type="hidden" class="positionInput" name="partner[<?=$i?>][position]" value="<?=$partner->getPosition()?>" /> 
                </td>
                <td width="165px">
                    <span style="font-size: 11px;"><?=ajax_link(substr($partner->getName(), 0, 27), 'partner/edit?id_partner='.$partner->getIdPartner()) ?></span><br/>
                    <span style="font-style: italic; font-size: 10px; color: #888;"><?=$partner->getPartnerType()?></span><br/>
		    <p style="font-size: 10px; text-transform: uppercase; text-align: right;"">
			<? if ($partner->getStatus() == '0') { echo ajax_link('Afficher','partner/setStatus?id_partner='.$partner->getIdPartner()); } else { echo ajax_link('Cacher','partner/setStatus?id_partner='.$partner->getIdPartner()); } ?>
		    </p>
                </td>
            </tr>
        </table>
      
       
    </li>
  <? endforeach; ?>
  <li style="clear: left; border: 0px;"></li>
</ul>
</form>
