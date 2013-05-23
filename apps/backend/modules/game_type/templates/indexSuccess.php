<h2>Genres de jeux</h2>

<table class="table">
  <thead>
    <tr>
      <th>Type</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($game_types as $game_type): ?>
    <tr>
      <td><?php echo $game_type->getLabel() ?></td>
      <td><a href="<?php echo url_for('game_type/edit?id_game_type='.$game_type->getIdGameType()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br />
<a href="<?php echo url_for('game_type/new') ?>" class="button add">Ajouter un nouveau genre</a>
