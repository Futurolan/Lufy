<h3><?php echo __('Liste des inscrits')?></h3>

<table width="100%">
<?php $i = 0 ?>
<?php foreach ($tournaments as $tournament): ?>
    <?php if ($i == 0): ?>
        <tr>
    <?php endif; ?>
    <?php $i++; ?>
        <td>
            <?php echo image_tag('/uploads/jeux/icones/' . $tournament->getLogourl(), 'alt="' . $tournament->getName() . '"') ?>
            <?php echo link_to($tournament->getName(), 'tournament/list?slug='.$tournament->getSlug())?>
        </td>
    <?php if ($i%3 == 0): ?>
        </tr><tr>
    <?php endif; ?>
    
<?php endforeach; ?>
</table>
<br />
<hr />
<br />
<?php if (!$tournamentDetail): ?>
    <div class="flashbox info"><?php echo __('Selectionner un tournoi pour voir la liste des inscrits.')?></div>
<?php else: ?>
    <h3><?php echo image_tag('/uploads/jeux/icones/' . $tournamentDetail->getLogourl(), 'alt="' . $tournamentDetail->getName() . '"') ?> <?php echo $tournamentDetail->getName()?></h3>
    <br />
    <?php include_component('tournament_slot', 'teamWithoutPlayers', array('idtournament' => $tournamentDetail->getIdTournament(), 'numberteam' => $tournamentDetail->getNumberTeam())) ?>
<?php endif; ?>