<table class="tournament" cellspacing="0" cellpadding="0" margin="0">
    <tbody>
	<?php foreach ($tournaments as $tournament): ?>
	   <tr onClick="javascript:showTournamentInfo(<?php echo $tournament['id']?>)" style=" height: 30px;">
                <td valign="middle" class="icone">
                    <?php echo  image_tag('/uploads/jeux/icones/' . $tournament['logo'], 'alt="' . $tournament['name'] . '"') ?>
                </td>
                <td>
                    <?php echo  link_to($tournament['name'], 'tournament/view?slug='.$tournament['slug'])?><br/>
                    <div style="width: 150px; height: 5px; background: #eee; border: solid 1px #ccc;">
                        <div style="height: 5px; width: <?php echo $tournament['percent_valides']*1.5?>px; background: #c63527; background: #ffcd00;"></div>
                    </div>
		</td>
	    </tr>
	    <tr>
		<td></td>
		<td>
			<ul id="tournament-info-<?php echo $tournament['id']?>" style="width: 130px;display: none; font-size: 10px; background: #eee; border: solid 1px #ddd; margin: 0px 10px 5px 5px;">
			    <li><?php echo $tournament['nb_slots']?> <?php echo __('slots')?></li>
			    <li><?php echo $tournament['nb_inscrits']?> <?php echo __('equipes inscrites')?></li>
			    <li><?php echo __('dont')?> <?php echo $tournament['nb_valides']?> <?php echo __('validees')?></li>
			</ul>
                </td>
	    </tr>
	<?php endforeach; ?>
</table>

<script>
function showTournamentInfo(id) {
    $('#tournament-info-'+id).toggle(200);
}
</script>
