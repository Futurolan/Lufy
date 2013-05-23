<div class="subnavigation">
  <span><?=ajax_link('En attentes', 'ipn/listNotChecked')?></span>
  <span><?=ajax_link('Archiv&eacute;s', 'ipn/listChecked')?></span>
  <span><?=ajax_link('Toutes', 'ipn/listAll')?></span>
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
<? foreach ($ipns as $ipn): ?>
  <? if ($ipn->getStatus() == 'Refunded' && $ipn->getIsChecked() == 0): ?>
    <tr style="background: #ffdddd;">
  <? elseif ($ipn->getStatus() == 'Completed' && $ipn->getIsChecked() == 0): ?>
    <tr style="background: #ddffdd;">
  <? elseif ($ipn->getIsChecked() == 1): ?>
    <tr style="background: #fafafa;">
  <? else: ?>
    <tr style="background: #eeeeee;">
  <? endif; ?>
    <td><?=ajax_link('Check', 'ipn/check?id='.$ipn->getId())?></td>
    <td><?=ajax_link($ipn->getCreatedAt(), 'ipn/view?id='.$ipn->getId())?></td>
    <td><?=$ipn->getTxnId()?></td>
    <td><?=$ipn->getAmount()?> <?=$ipn->getCurrency()?></td>
    <td><?=$ipn->getLicenceGa()?></td>
    <td><?=$ipn->getEmail()?></td>
  </tr>
<? endforeach; ?>
</table>
