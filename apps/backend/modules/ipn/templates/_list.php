<div class="subnavigation">
  <span><?php echo ajax_link('En attentes', 'ipn/listNotChecked')?></span>
  <span><?php echo ajax_link('Archiv&eacute;s', 'ipn/listChecked')?></span>
  <span><?php echo ajax_link('Toutes', 'ipn/listAll')?></span>
</div>

<table class="table">
  <tr>
    <th> </th>
    <th>Date</th>
    <th>ID Transaction</th>
    <th>Montant</th>
    <th>Num joueur</th>
    <th>Email</th>
  </tr>
<?php foreach ($ipns as $ipn): ?>
  <?php if ($ipn->getStatus() == 'Refunded' && $ipn->getIsChecked() == 0): ?>
    <tr style="background: #ffdddd;">
  <?php elseif ($ipn->getStatus() == 'Completed' && $ipn->getIsChecked() == 0): ?>
    <tr style="background: #ddffdd;">
  <?php elseif ($ipn->getIsChecked() == 1): ?>
    <tr style="background: #fafafa;">
  <?php else: ?>
    <tr style="background: #eeeeee;">
  <?php endif; ?>
    <td><?php echo ajax_link('Check', 'ipn/check?id='.$ipn->getId())?></td>
    <td><?php echo ajax_link($ipn->getCreatedAt(), 'ipn/view?id='.$ipn->getId())?></td>
    <td><?php echo $ipn->getTxnId()?></td>
    <td><?php echo $ipn->getAmount()?> <?php echo $ipn->getCurrency()?></td>
    <td><?php echo $ipn->getLicenceGa()?></td>
    <td><?php echo $ipn->getEmail()?></td>
  </tr>
<?php endforeach; ?>
</table>
