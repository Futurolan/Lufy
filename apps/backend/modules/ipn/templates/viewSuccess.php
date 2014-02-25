<h2>Notification Paypal #<?=$ipn->getId()?></h2>

<h3>Informations sur la notification</h3>
<table class="table">
  <tr>
    <th>Date</th>
    <td><?=$ipn->getCreatedAt()?></td>
  </tr>
  <tr>
    <th>Num transaction</th>
    <td><?=$ipn->getTxnId()?></td>
  </tr>
  <tr>
    <th>Montant</th>
    <td><?=$ipn->getAmount().' '.$ipn->getCurrency()?></td>
  </tr>
  <tr>
    <th>Statut</th>
    <td><?=$ipn->getStatus()?></td>
  </tr>
  <tr>
    <th>Licence GA</th>
    <td><?=$ipn->getLicenceGa()?></td>
  </tr>
  <tr>
    <th>Email acheteur</th>
    <td><?=$ipn->getEmail()?></td>
  </tr>

</table>

<br/>
<div style="width: 48%; float: left;">
<h3>Informations sur l'utilisateur</h3>

<? if ($user): ?>
  <table class="table">
    <tr>
      <th>Nom</th>
      <td><?=$user->getFirstName()?> "<?=link_to($user->getUsername(), 'user/view?user_id='.$user->getId())?>" <?=$user->getLastName()?></td>
    </tr>
    <tr>
      <th>Equipe</th>
      <td><?=link_to($user->Team[0]->getName(), 'team/view?id_team='.$user->Team[0]->getIdTeam())?></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><?=$user->getEmailAddress()?></td>
    </tr>
    <tr>
      <th>T&eacute;l&eacute;phone</th>
      <td><?=$user->getPhone()?></td>
    </tr>
    <tr>
      <th>Adresse</th>
      <td><?=$user->getAddress()?><br/><?=$user->getZipcode()?> <?=$user->getCity()?><br/><?=$user->getCountry()?></td>
    </tr>
  </table>
<? else: ?>
  <div class="flashbox error">Aucun utilisateur correspond &agrave; la licence GA.</div>
<? endif; ?>
</div>

<div style="width: 48%; float: left; margin-left: 30px;">
<h3>Informations sur l'inscription</h3>

<? if ($user->Team[0]->TournamentSlot): ?>
  <div>
  <table class="table">
    <tr>
      <th>Tournoi</th>
      <td><?=link_to($user->Team[0]->TournamentSlot->getTournament(), 'tournament_slot/tournament?slug='.$user->Team[0]->TournamentSlot->getTournament()->getSlug())?></td>
    </tr>
    <tr>
      <th>Slot</th>
      <td><?=link_to($user->Team[0]->TournamentSlot->getIdTournamentSlot(), 'tournament_slot/edit?id_tournament_slot='.$user->Team[0]->TournamentSlot->getIdTournamentSlot())?> <i>(<?=$user->Team[0]->TournamentSlot->getStatus()?>)</i> - <s>Valider le slot</s></td>
    </tr>
    <tr>
      <th>Commande</th>
      <td><?=link_to($user->Team[0]->TournamentSlot->getCommande(), 'commande/edit?id_commande='.$user->Team[0]->TournamentSlot->getCommande()->getIdCommande())?></td>
    </tr>
    <tr>
      <td colspan="2">
        <?=$user->Team[0]->TournamentSlot->getCommande()->getPayement()->count()?> paiement(s)
        <? if ($user->Team[0]->TournamentSlot->getCommande()->getPayement()->count() == 1): ?>
          <? if ($user->Team[0]->TournamentSlot->getCommande()->Payement[0]->getIsValid() != 1): ?>
            <?=ajax_component('Valider le paiement', 'payement/validateIpn?id_payement='.$user->Team[0]->TournamentSlot->getCommande()->Payement[0]->getIdPayement().'&id_txn='.$ipn->getTxnId(), array('class' => 'btn btn-default small'))?>
          <? else: ?>
            <span style="font-style: italic;">Valid&eacute;</span>
          <? endif; ?>
        <? endif; ?>
      </td
    </tr>
  </table>
  </div>
<? else: ?>
  <div class="flashbox error">Aucune information sur l'inscription.</div>
<? endif; ?>
</div>

<div style="clear: left;"></div>
