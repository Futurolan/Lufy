<h2>Poker tournaments List</h2>

<a class="button" href="<?php echo url_for('poker_tournament/new') ?>">Ajouter un tournoi</a>

<table class="table">
  <thead>
    <tr>
      <th>Tournois</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($poker_tournaments as $poker_tournament): ?>
    <tr>
      <td <? if ($poker_tournament->getIsActive() == 0) echo 'class"inactive"';?>><a href="<?php echo url_for('poker_tournament/edit?id_poker_tournament='.$poker_tournament->getIdPokerTournament()) ?>"><?php echo $poker_tournament->getName() ?></a></td>
      <td>
        <a href="<?php echo url_for('poker_tournament/edit?id_poker_tournament='.$poker_tournament->getIdPokerTournament()) ?>">Modifier</a> - 
        <?php echo ajax_link('Supprimer', 'poker_tournament/delete?id_poker_tournament='.$poker_tournament->getIdPokerTournament(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

