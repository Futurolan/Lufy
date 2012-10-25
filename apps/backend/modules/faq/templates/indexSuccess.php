<script type="text/javascript">
	$(function() {
		$("#jquery-ui-faq").sortable({
            update : function(event,ui){
                var list = ui.item.parent("ul");
                var pos = 0;
                $(list.find("li")).each(function(){
                    pos++;
                    $(this).find('input.positionInput').val(pos);
                });
            }
        });
		$("#jquery-ui-faq").disableSelection();
	});
</script>

<h2>Foire aux questions</h2>

<form method="POST" action="<?=url_for('faq/updatePosition')?>">

<input type="submit" value="Enregistrer les changements"  class="button"/>
<a href="<?php echo url_for('faq/new') ?>" class="button">Ajouter une question</a>

<ul id="jquery-ui-faq">
  <? $i= 0; foreach ($faqs as $faq): $i++; ?>
    <?php
    if ($faq->getStatus() == '0'): ?>
        <li class="inactive">
    <? else: ?>
        <li>
    <? endif; ?>
        <table width="800px;">
            <tr>
                <td>
                    <span style="font-size: 14px;"><?=strtoupper($faq->getRequest())?></span>
                    <input type="hidden" name="faq[<?=$i?>][id]" value="<?=$faq->getIdFaq()?>" />
                    <input type="hidden" class="positionInput" name="faq[<?=$i?>][position]" value="<?=$faq->getPosition()?>" /> 
                </td>
                <td width="150px">
                    <?php echo ajax_link('Modifier','faq/edit?id_faq='.$faq->getIdFaq()) ?> - 
                    <?php echo ajax_link('Visible/Cach&eacute;','faq/setStatus?id_faq='.$faq->getIdFaq()) ?> 
                </td>
            </tr>
        </table>
      
       
    </li>
  <? endforeach; ?>
</ul>
</form>