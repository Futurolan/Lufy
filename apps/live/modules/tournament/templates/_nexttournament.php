<table class="tournament" cellspacing="0" cellpadding="0" margin="0">
    <tbody>
	<? foreach ($tournaments as $tournament): ?>
	   <tr onClick="javascript:showTournamentInfo(<?=$tournament['id']?>)" style=" height: 30px;">
                <td valign="middle" class="icone">
                    <?= image_tag('/uploads/jeux/icones/' . $tournament['logo'], 'alt="' . $tournament['name'] . '"') ?>
                </td>
                <td>
                    <?= link_to($tournament['name'], 'tournament/view?slug='.$tournament['slug'])?><br/>
		</td>
	    </tr>
	<? endforeach; ?>
</table>
