<table class="tournament" cellspacing="0" cellpadding="0" margin="0">
    <tbody>
	<?php foreach ($tournaments as $tournament): ?>
	   <tr onClick="javascript:showTournamentInfo(<?php echo $tournament['id']?>)" style=" height: 30px;">
                <td valign="middle" class="icone">
                    <?php echo  image_tag('/uploads/jeux/icones/' . $tournament['logo'], 'alt="' . $tournament['name'] . '"') ?>
                </td>
                <td>
                    <?php echo  link_to($tournament['name'], 'tournament/view?slug='.$tournament['slug'])?><br/>
		</td>
	    </tr>
	<?php endforeach; ?>
</table>
