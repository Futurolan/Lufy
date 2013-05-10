<h2>Equipes > <?php echo $team->getName()?></h2>

<fieldset>
    <legend>Informations</legend>
    <table class="table">
        <tr>
            <th>Equipe</th>
            <td><?php echo $team->getName()?></td>
        </tr>
        <tr>
            <th>Tag</th>
            <td><?php echo $team->getTag()?></td>
        </tr>
        <tr>
            <th>Pays</th>
            <td><?$team->getCountry()?></td>
        </tr>
        <tr>
            <th>Site web</th>
            <td><?php echo $team->getWebsite()?></td>
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
              <?php if ($team->getTournamentSlot()->getIdTournamentSlot()): ?>
                <?php echo ajax_link($team->getTournamentSlot()->getIdTournamentSlot(), 'tournament_slot/tournament?slug='.$team->getTournamentSlot()->getTournament()->getSlug())?>
              <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Tournoi</th>
            <td>
              <?php if ($team->getTournamentSlot()->getTournament()->getName()): ?>
                <?php echo ajax_link($team->getTournamentSlot()->getTournament()->getName(), 'tournament/edit?id_tournament='.$team->getTournamentSlot()->getTournamentId())?>
              <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Statut</th>
            <td><?php echo $team->getTournamentSlot()->getStatus()?></td>
        </tr>
        <tr>
            <th>ID commande</th>
            <td>
              <?php if ($team->getTournamentSlot()->getCommande()->getIdCommande()): ?>
                <?php echo ajax_link($team->getTournamentSlot()->getCommande()->getIdCommande(), 'commande/edit?id_commande='.$team->getTournamentSlot()->getCommande()->getIdCommande())?>
              <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Montant commande</th>
            <td><?php echo $team->getTournamentSlot()->getCommande()->getAmount()?> &euro;</td>
        </tr>
        <?php foreach ($team->getTournamentSlot()->getCommande()->getPayement() as $payement): ?>
            <tr id="payement-<?php echo $payement->getIdPayement()?>">
                <th>Montant paiement</th>
                <td>
                    <?php echo $payement->getAmount()?> &euro; 
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
                    <?php echo ajax_link('Voir le paiement', 'payement/edit?id_payement='.$payement->getIdPayement(), array('class' => 'button small'))?>
                    <a class="button small" onclick="payement_delete(<?php echo $payement->getIdPayement()?>);">Supprimer le paiement</a>
                </td>
            </tr>
        <?php endforeach; ?>

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
                <?php echo ajax_link($player->getSfGuardUser()->getUsername(), 'user/view?user_id='.$player->getSfGuardUser()->getId())?> (<?php echo $player->getSfGuardUser()->getFirstName()?> <?php echo $player->getSfGuardUser()->getLastName()?>)
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
