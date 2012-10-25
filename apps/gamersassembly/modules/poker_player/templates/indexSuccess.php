<h1>Poker tournament players List</h1>

<table>
  <thead>
    <tr>
      <th>Id poker tournament player</th>
      <th>User</th>
      <th>Poker tournement</th>
      <th>Pseudo</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($poker_tournament_players as $poker_tournament_player): ?>
    <tr>
      <td><a href="<?php echo url_for('poker_player/edit?id_poker_tournament_player='.$poker_tournament_player->getIdPokerTournamentPlayer()) ?>"><?php echo $poker_tournament_player->getIdPokerTournamentPlayer() ?></a></td>
      <td><?php echo $poker_tournament_player->getUserId() ?></td>
      <td><?php echo $poker_tournament_player->getPokerTournementId() ?></td>
      <td><?php echo $poker_tournament_player->getPseudo() ?></td>
      <td><?php echo $poker_tournament_player->getCreatedAt() ?></td>
      <td><?php echo $poker_tournament_player->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('poker_player/new') ?>">New</a>
