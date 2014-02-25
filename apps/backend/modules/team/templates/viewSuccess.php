<h2>Equipes > <?=$team->getName()?></h2>

<fieldset>
    <legend>Informations</legend>
    <table class="table">
        <tr>
            <th>Equipe</th>
            <td><?=$team->getName()?></td>
        </tr>
        <tr>
            <th>Tag</th>
            <td><?=$team->getTag()?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?$team->getCountry()?></td>
        </tr>
        <tr>
            <th>Site web</th>
            <td><?=$team->getWebsite()?></td>
        </tr>
</table>
<a class="btn btn-default" href="<?= url_for('team/edit?id_team=' . $team->getIdTeam()) ?>">Modifier &eacute;quipe</a>
</fieldset>
<fieldset>
    <legend>Inscription</legend>
    <table class="table">
        <tr>
            <th>ID Slot</th>
            <td>
              <? if ($team->getTournamentSlot()->getIdTournamentSlot()): ?>
                <?=link_to($team->getTournamentSlot()->getIdTournamentSlot(), 'tournament_slot/tournament?slug='.$team->getTournamentSlot()->getTournament()->getSlug())?>
              <? endif; ?>
            </td>
        </tr>
        <tr>
            <th>Tournoi</th>
            <td>
              <? if ($team->getTournamentSlot()->getTournament()->getName()): ?>
                <?=link_to($team->getTournamentSlot()->getTournament()->getName(), 'tournament/edit?id_tournament='.$team->getTournamentSlot()->getTournamentId())?>
              <? endif; ?>
            </td>
        </tr>
        

    </table>
</fieldset>
<br/>
<fieldset>
    <legend>Composition</legend>
    <table class="table">
    <?php
    foreach ($team->getTeamPlayer() as $player):
    ?>
        <tr>
            <th>
            <?php
            if ($player->getIsPlayer() == 1):
                echo 'Joueur';
            else:
                echo 'Non joueur';
            endif;
            if ($player->getIsCaptain() == 1):
                echo ' - Manager';
            endif;
            ?>
            </th>
            <td>
                <?=link_to($player->getSfGuardUser()->getUsername(), 'user/view?user_id='.$player->getSfGuardUser()->getId())?> (<?=$player->getSfGuardUser()->getFirstName()?> <?=$player->getSfGuardUser()->getLastName()?>)
            </td>
        </tr>
    <?php
    endforeach;
    ?>
    </table>
</fieldset>

<script>
function payement_delete(id) {
  if (confirm('Continuer ?')) {
    $.get('/payement/delete',
      { 'id_payement': id },
      function success(data) {
        $('#payement-'+id).hide();
      });
  }
}
</script>
