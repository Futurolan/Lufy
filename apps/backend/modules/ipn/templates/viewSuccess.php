<h2>Notification Paypal #<?php echo $ipn->getId()?></h2>

<h3>Informations sur la notification</h3>
<table class="table">
  <tr>
    <th>Date</th>
    <td><?php echo $ipn->getCreatedAt()?></td>
  </tr>
  <tr>
    <th>Num transaction</th>
    <td><?php echo $ipn->getTxnId()?></td>
  </tr>
  <tr>
    <th>Montant</th>
    <td><?php echo $ipn->getAmount().' '.$ipn->getCurrency()?></td>
  </tr>
  <tr>
    <th>Statut</th>
    <td><?php echo $ipn->getStatus()?></td>
  </tr>
  <tr>
    <th>Licence GA</th>
    <td><?php echo $ipn->getLicenceGa()?></td>
  </tr>
  <tr>
    <th>Email acheteur</th>
    <td><?php echo $ipn->getEmail()?></td>
  </tr>

</table>

<br/>
<div style="width: 48%; float: left;">
<h3>Informations sur l'utilisateur</h3>

<?php if ($user): ?>
  <table class="table">
    <tr>
      <th>Nom</th>
      <td><?php echo $user->getFirstName()?> "<?php echo ajax_link($user->getUsername(), 'user/view?user_id='.$user->getId(), array('target' => '_blank'))?>" <?php echo $user->getLastName()?></td>
    </tr>
    <tr>
      <th>Equipe</th>
      <td><?php echo ajax_link($user->Team[0]->getName(), 'team/view?id_team='.$user->Team[0]->getIdTeam(), array('target' => 'blank'))?></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><?php echo $user->getEmailAddress()?></td>
    </tr>
    <tr>
      <th>T&eacute;l&eacute;phone</th>
      <td><?php echo $user->getPhone()?></td>
    </tr>
    <tr>
      <th>Adresse</th>
      <td><?php echo $user->getAddress()?><br/><?php echo $user->getZipcode()?> <?php echo $user->getCity()?><br/><?php echo $user->getCountry()?></td>
    </tr>
  </table>
<?php else: ?>
  <div class="flashbox error">Aucun utilisateur correspond &agrave; la licence GA.</div>
<?php endif; ?>
</div>

<div style="width: 48%; float: left; margin-left: 30px;">
<h3>Informations sur l'inscription</h3>

<?php if ($user->Team[0]->TournamentSlot): ?>
  <div>
  <table class="table">
    <tr>
      <th>Tournoi</th>
      <td><?php echo ajax_link($user->Team[0]->TournamentSlot->getTournament(), 'tournament_slot/tournament?slug='.$user->Team[0]->TournamentSlot->getTournament()->getSlug(), array('target' => '_blank'))?></td>
    </tr>
    <tr>
      <th>Slot</th>
      <td><?php echo ajax_link($user->Team[0]->TournamentSlot->getIdTournamentSlot(), 'tournament_slot/edit?id_tournament_slot='.$user->Team[0]->TournamentSlot->getIdTournamentSlot(), array('target' => '_blank'))?> <i>(<?php echo $user->Team[0]->TournamentSlot->getStatus()?>)</i> - <s>Valider le slot</s></td>
    </tr>
    <tr>
      <th>Commande</th>
      <td><?php echo ajax_link($user->Team[0]->TournamentSlot->getCommande(), 'commande/edit?id_commande='.$user->Team[0]->TournamentSlot->getCommande()->getIdCommande(), array('target' => '_blank'))?></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo $user->Team[0]->TournamentSlot->getCommande()->getPayement()->count()?> paiement(s) <?php if ($user->Team[0]->TournamentSlot->getCommande()->getPayement()->count() > 1) { echo '- <s>Nettoyer</s>'; }?></td
    </tr>
  </table>
  </div>
<?php else: ?>
  <div class="flashbox error">Aucune information sur l'inscription.</div>
<?php endif; ?>
</div>

<div style="clear: left;"></div>
