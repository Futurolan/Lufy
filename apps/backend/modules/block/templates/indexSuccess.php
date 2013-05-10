<script type="text/javascript">
	$(function() {
		$("#jquery-ui-block").sortable({
            update : function(event,ui){
                var list = ui.item.parent("ul");
                var pos = 0;
                $(list.find("li")).each(function(){
                    pos++;
                    $(this).find('input.positionInput').val(pos);
                });
            }
        });
		$("#jquery-ui-block").disableSelection();
	});
</script>

<h2>Administration des encarts</h2>

<form method="POST" action="<?php echo url_for('block/updatePosition')?>">

<input type="submit" value="Enregistrer les changements"  class="button"/>
<a href="<?php echo url_for('block/new') ?>" class="button">Ajouter un encart</a>

<ul id="jquery-ui-block">
  <?php $i= 0; foreach ($blocks as $block): $i++; ?>
    <?php
    if ($block->getIsActive() == '0'): ?>
        <li class="inactive">
    <?php else: ?>
        <li>
    <?php endif; ?>
        <table width="800px;">
            <tr height="70">
                <td width="120px" align="center" valign="center">
                    <?php echo image_tag('/uploads/encarts/'.$block->getImage(), 'style="max-width: 110px; max-height: 70px;" alt="'.$block->getTitle().'"')?>
                    <input type="hidden" name="block[<?php echo $i?>][id]" value="<?php echo $block->getIdBlock()?>" />
                    <input type="hidden" class="positionInput" name="block[<?php echo $i?>][position]" value="<?php echo $block->getPosition()?>" />
                </td>
                <td width="610px">
                    <span style="font-size: 14px;"><?php echo strtoupper($block->getTitle())?></span><br/>
                    <span style="font-size: 10px; font-style: italic;"><?php echo $block->getLink()?></span>
                </td>
                <td width="100px">
                    <?php echo ajax_link('Modifier','block/edit?id_block='.$block->getIdBlock()) ?> <br/>
                    <?php echo ajax_link('Visible/Cach&eacute;','block/setStatus?id_block='.$block->getIdBlock()) ?>
                </td>
            </tr>
        </table>


    </li>
  <?php endforeach; ?>
</ul>
</form>
