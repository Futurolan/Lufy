<h2><?=$tournament->getEvent()->getName()?> - Slots <?=$tournament->getName()?></h2>

<table class="table">
  <thead>
    <tr>
      <th></th>
      <th>Team</th>
      <th>Tournament</th>
      <th>Position</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tournament_slots as $tournament_slot): ?>
    <tr>
      <td><? if ($tournament_slot->getLocked() == 1) echo image_tag('16/lock.png'); else echo image_tag('16/unlock.png');?></td>
      <td><?php
      if ($tournament_slot->getTeamId() != '0' && $tournament_slot->getTeamId() != NULL):
        echo ajax_link($tournament_slot->teamName($tournament_slot->getTeamId()), 'team/view?id_team='.$tournament_slot->getTeamId());
      endif;        ?></td>
      <td><?php echo ajax_link($tournament_slot->getTournament(), 'tournament/edit?id_tournament='.$tournament_slot->getTournamentId()) ?></td>
      <td><?php echo $tournament_slot->getPosition() ?></td>
      <td><?php echo $tournament_slot->getStatus() ?></td>
      <td><a href="<?php echo url_for('tournament_slot/edit?id_tournament_slot='.$tournament_slot->getIdTournamentSlot()) ?>">Modifier</a>
          - <?php echo ajax_link('Liberer le slot', 'tournament_slot/setLibre?id_tournament_slot=' . $tournament_slot->getIdTournamentSlot()) ?>
      - <?php echo ajax_link('Valider le slot', 'tournament_slot/setValide?id_tournament_slot=' . $tournament_slot->getIdTournamentSlot()) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
