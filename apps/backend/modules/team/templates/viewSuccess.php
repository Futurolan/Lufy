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
</fieldset>
<br/>
<fieldset>
    <legend>Inscription</legend>
    <table class="table">
        <tr>
            <th>ID Slot</th>
            <td>
              <? if ($team->getTournamentSlot()->getIdTournamentSlot()): ?>
                <?=ajax_link($team->getTournamentSlot()->getIdTournamentSlot(), 'tournament_slot/tournament?slug='.$team->getTournamentSlot()->getTournament()->getSlug())?>
              <? endif; ?>
            </td>
        </tr>
        <tr>
            <th>Tournoi</th>
            <td>
              <? if ($team->getTournamentSlot()->getTournament()->getName()): ?>
                <?=ajax_link($team->getTournamentSlot()->getTournament()->getName(), 'tournament/edit?id_tournament='.$team->getTournamentSlot()->getTournamentId())?>
              <? endif; ?>
            </td>
        </tr>
        <tr>
            <th>Statut</th>
            <td><?=$team->getTournamentSlot()->getStatus()?></td>
        </tr>
        <tr>
            <th>ID commande</th>
            <td>
              <? if ($team->getTournamentSlot()->getCommande()->getIdCommande()): ?>
                <?=ajax_link($team->getTournamentSlot()->getCommande()->getIdCommande(), 'commande/edit?id_commande='.$team->getTournamentSlot()->getCommande()->getIdCommande())?>
              <? endif; ?>
            </td>
        </tr>
        <tr>
            <th>Montant commande</th>
            <td><?=$team->getTournamentSlot()->getCommande()->getAmount()?> &euro;</td>
        </tr>
        <? foreach ($team->getTournamentSlot()->getCommande()->getPayement() as $payement): ?>
            <tr id="payement-<?=$payement->getIdPayement()?>">
                <th>Montant paiement</th>
                <td>
                    <?=$payement->getAmount()?> &euro; 
                    (
                    <?
                    if ($payement->getIsPaypal() == 1):
                        echo 'Paypal';
                    else:
                        echo 'Cheque';
                    endif;
                    ?>
                     - 
                    <?
                    if ($payement->getIsValid() == 1):
                        echo 'Valide';
                    else:
                        echo 'En attente';
                    endif;
                    ?>
                    ) 
                    <?=ajax_link('Voir le paiement', 'payement/edit?id_payement='.$payement->getIdPayement(), array('class' => 'button small'))?>
                    <a class="button small" onclick="payement_delete(<?=$payement->getIdPayement()?>);">Supprimer le paiement</a>
                </td>
            </tr>
        <? endforeach; ?>

    </table>
</fieldset>
<br/>
<fieldset>
    <legend>Composition</legend>
    <table class="table">
    <?
    foreach ($team->getTeamPlayer() as $player):
    ?>
        <tr>
            <th>
            <?
            if ($player->getIsPlayer() == 1):
                echo 'Joueur';
            else:
                echo 'Non joueur';
            endif;
            if ($player->getIsCaptain() == 1):
                echo ' - Capitaine';
            endif;
            ?>
            </th>
            <td>
                <?=ajax_link($player->getSfGuardUser()->getUsername(), 'user/view?user_id='.$player->getSfGuardUser()->getId())?> (<?=$player->getSfGuardUser()->getFirstName()?> <?=$player->getSfGuardUser()->getLastName()?>)
            </td>
        </tr>
    <?
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
