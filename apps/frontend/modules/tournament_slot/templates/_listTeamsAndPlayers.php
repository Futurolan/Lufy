<table class="table table-condensed table-striped">
  <tr>
      <th></th>
      <th>#</th>
      <th><?php echo __('Equipe')?></th>
      <th><?php echo __('Joueur(s)')?></th>
  </tr>
  
  <? $i = 1; ?>
  
  <? foreach ($slots as $slot): ?>
    <? if ($slot->getIsValid() == 1): ?>
      <tr>
        <td></td>
        <td>#<?=$i?></td>
        <td><?=$slot->getTeam()->getName()?></td>
        <td><? include_component('team', 'listPlayers', array('idteam' => $slot->getTeamId())) ?></td>
      </tr>
      <? $i++; ?>
    <? endif; ?>
  <? endforeach; ?>
  
  <? for ($i; $i <= $nb_slots; $i++): ?>
    <tr>
      <td></td>
      <td>#<?=$i?></td>
      <td><span class="muted">libre</span></td>
      <td></td>
    </tr>
  <? endfor; ?>

  <tr>
    <th colspan="4"style="text-align: center;"> <?=__('Debut de la liste dattente')?> </th>
  </tr>

  <? foreach ($slots as $slot): ?>
    <? if ($slot->getIsValid() != 1): ?>
      <tr>
        <td></td>
        <td>#<?=$i?></td>
        <td><?=$slot->getTeam()->getName()?></td>
        <td><? include_component('team', 'listPlayers', array('idteam' => $slot->getTeamId())) ?></td>
      </tr>
      <? $i++; ?>
    <? endif; ?>
  <? endforeach; ?>
</table>
