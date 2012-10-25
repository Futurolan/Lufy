<h2>Liste des commandes</h2>

<a href="<?php echo url_for('commande/new') ?>" class="button">Ajouter une commande</a>

<table class="table">
  <thead>
    <tr>
      <th>#ID</th>
      <th>Slot ID</th>
      <th>Objet</th>
      <th>Montant</th>
      <th>Cr&eacute;&eacute; le</th>
      <th>Modifi&eacute; le</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($commandes as $commande): ?>
    <tr>
      <td><a href="<?php echo url_for('commande/edit?id_commande='.$commande->getIdCommande()) ?>"><?php echo $commande->getIdCommande() ?></a></td>
      <td><?php echo ajax_link($commande->getTournamentSlotId(), 'tournament_slot/tournament?slug='.$commande->getTournamentSlot()->getTournament()->getSlug()) ?> (<?=$commande->getTournamentSlot()->getTournament()->getName()?>)</td>
      <td><?php echo $commande->getItemName() ?></td>
      <td><?php echo $commande->getAmount() ?> &euro;</td>
      <td><?php echo $commande->getCreatedAt() ?></td>
      <td><?php echo $commande->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
