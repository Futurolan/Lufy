<h3><?=__('Liste des inscrits')?></h3>

<table width="100%">
<? $i = 0 ?>
<? foreach ($tournaments as $tournament): ?>
    <? if ($i == 0): ?>
        <tr>
    <? endif; ?>
    <? $i++; ?>
        <td>
            <?=image_tag('/uploads/jeux/icones/' . $tournament->getLogourl(), 'alt="' . $tournament->getName() . '"') ?>
            <?=link_to($tournament->getName(), 'tournament/list?slug='.$tournament->getSlug())?>
        </td>
    <? if ($i%3 == 0): ?>
        </tr><tr>
    <? endif; ?>
    
<? endforeach; ?>
</table>
<br />
<hr />
<br />
<? if (!$tournamentDetail): ?>
    <div class="flashbox info"><?=__('Selectionner un tournoi pour voir la liste des inscrits.')?></div>
<? else: ?>
    <h3><?=image_tag('/uploads/jeux/icones/' . $tournamentDetail->getLogourl(), 'alt="' . $tournamentDetail->getName() . '"') ?> <?=$tournamentDetail->getName()?></h3>
    <br />
    <?php include_component('tournament_slot', 'teamWithoutPlayers', array('idtournament' => $tournamentDetail->getIdTournament(), 'numberteam' => $tournamentDetail->getNumberTeam())) ?>
<? endif; ?>