<h2>Jeux</h2>

<a href="<?php echo url_for('game/new') ?>" class="button add">Ajouter un jeu</a>

<table class="table">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Type</th>
      <th>Plateforme</th>
	  <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($games as $game): ?>
    <tr>
      <td><a href="<?=url_for('game/edit?id_game='.$game->getIdGame())?>"><?=$game->getLabel()?></a></td>
      <td><?=$game->getGameType()?></td>
      <td><?=$game->getPlateform()?></td>
      <td><a href="<?=url_for('game/edit?id_game='.$game->getIdGame())?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
