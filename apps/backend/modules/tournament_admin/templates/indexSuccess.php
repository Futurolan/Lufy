<h2>Liste des admins des tournois</h2>

<table class="table">
  <thead>
    <tr>
      <th>Admin</th>
      <th>Tournoi</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tournament_admins as $tournament_admin): ?>
    <tr>
      <td><?php echo $tournament_admin->getUsername($tournament_admin->getUserId()) ?></td>
      <td><?php echo $tournament_admin->getTournament() ?></td>
      <td><a href="<?php echo url_for('tournament_admin/edit?user_id='.$tournament_admin->getUserId()) ?>">modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tournament_admin/new') ?>" class="btn btn-default">Ajouter un admin</a>
