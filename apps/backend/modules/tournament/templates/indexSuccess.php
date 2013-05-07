<script type="text/javascript">
	$(function() {
		$("#jquery-ui-tournament").sortable({
            update : function(event,ui){
                var list = ui.item.parent("ul");
                var pos = 0;
                $(list.find("li")).each(function(){
                    pos++;
                    $(this).find('input.positionInput').val(pos);
                });
            }
        });
		$("#jquery-ui-tournament").disableSelection();
	});
</script>

<h2>Gestion des tournois</h2>

<form method="POST" action="<?php echo url_for('tournament/updatePosition')?>">

<input type="submit" value="Enregistrer les changements"  class="button save"/>
<a href="<?php echo url_for('tournament/new') ?>" class="button add">Ajouter un tournois</a>

<ul id="jquery-ui-tournament">
  <?php $i= 0; foreach ($tournaments as $tournament): $i++; ?>
    <?php
    if ($tournament->getIsActive() == '0'): ?>
        <li class="inactive">
    <?php else: ?>
        <li>
    <?php endif; ?>
        <table width="800px;">
            <tr height="30">
                <td width="30px" align="center" valign="center">
                    <?php echo image_tag('/uploads/jeux/icones/'.$tournament->getLogourl())?>
                    <input type="hidden" name="tournament[<?php echo $i?>][id]" value="<?php echo $tournament->getIdTournament()?>" />
                    <input type="hidden" class="positionInput" name="tournament[<?php echo $i?>][position]" value="<?php echo $tournament->getPosition()?>" /> 
                </td>
                <td width="305">
                    <a href="<?php echo url_for('tournament/view?slug='.$tournament->getSlug()) ?>"><?php echo $tournament->getName()?></a>
                </td>
                <td>
                    <?php echo $tournament->getEvent()?>
                </td>
                <td width="150px">
                    <?php echo ajax_link('Modifier','tournament/edit?id_tournament='.$tournament->getIdTournament()) ?> - 
                    <?php echo ajax_link('Visible/Cach&eacute;','tournament/setStatus?id_tournament='.$tournament->getIdTournament()) ?> 
                </td>
            </tr>
        </table>
      
       
    </li>
  <?php endforeach; ?>
</ul>
</form>
