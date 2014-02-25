<h2><?= $tournament->getEvent()->getName() ?> - Slots <?= $tournament->getName() ?></h2>

<table class="table">
  <thead>
    <tr>
      <th></th>
      <th>Team</th>
      <th>Tournament</th>
      <th>Validé ?</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tournament_slots as $tournament_slot): ?>
      <tr>
        <td><? if ($tournament_slot->getIsLocked() == 1) echo image_tag('16/lock.png');
    else echo image_tag('16/unlock.png'); ?></td>
        <td><?php
          if ($tournament_slot->getTeamId() != '0' && $tournament_slot->getTeamId() != NULL):
            echo link_to($tournament_slot->teamName($tournament_slot->getTeamId()), 'team/view?id_team=' . $tournament_slot->getTeamId());
          endif;
          ?></td>
        <td><?php echo link_to($tournament_slot->getTournament(), 'tournament/edit?id_tournament=' . $tournament_slot->getTournamentId()) ?></td>
        <td><?php
          if ($tournament_slot->getIsValid())
          {
            echo 'oui';
          }
          else
          {
            echo 'non';
          }
          ?>           
        </td>
        <td><a href="<?php echo url_for('tournament_slot/edit?id_tournament_slot=' . $tournament_slot->getIdTournamentSlot()) ?>">Modifier</a>
      </tr>
<?php endforeach; ?>
  </tbody>
</table>
&nbsp;<a href="<?php echo url_for('tournament_slot/index') ?>" class="btn btn-default">Retour a la liste des tournois</a>
