<h2>Liste des paiements</h2>

<a class="button" href="<?php echo url_for('payement/new') ?>">Ajouter un paiement</a>

<table class="table">
  <thead>
    <tr>
      <th>#ID</th>
      <th>Commande</th>
      <th>Payeur</th>
      <th>Txn</th>
      <th>Montant</th>
      <th>Valid&eacute;</th>
      <th>Paypal</th>
      <th>Cr&eacute;e le</th>
      <th>Mis &agrave; jour le</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($payements as $payement): ?>
    <tr>
      <td><a href="<?php echo url_for('payement/edit?id_payement='.$payement->getIdPayement()) ?>"><?php echo $payement->getIdPayement() ?></a></td>
      <td><?php echo ajax_link($payement->getCommandeId(), 'commande/edit?id_commande='.$payement->getCommandeId()) ?></td>
      <td><?php echo ajax_link($payement->getSfGuardUser()->getUsername(), 'user/view?user_id='.$payement->getSfGuardUser()->getId()) ?></td>
      <td><?php echo $payement->getTxnId() ?></td>
      <td><?php echo $payement->getAmount() ?> &euro;</td>
      <td>
        <?php if ($payement->getIsValid() == 1): ?>
          oui
        <?php else: ?>
          non
        <?php endif; ?>
      </td>
      <td>
        <?php if ($payement->getIsPaypal() == 1): ?>
          oui
        <?php else: ?>
          non
        <?php endif; ?>
      </td>
      <td><?php echo $payement->getCreatedAt() ?></td>
      <td><?php echo $payement->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
