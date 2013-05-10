<h2>Plateformes de jeu</h2>

<table class="table">
  <thead>
    <tr>
      <th>Nom complet</th>
      <th>Nom court</th>
      <th>Constructeur</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($plateforms as $plateform): ?>
    <tr>
      <td><a href="<?php echo url_for('plateform/edit?id_plateform='.$plateform->getIdPlateform()) ?>"><?php echo $plateform->getName() ?></a></td>
      <td><?php echo $plateform->getTag() ?></td>
      <td><?php echo $plateform->getConstructor() ?></td>
      <td><a href="<?php echo url_for('plateform/edit?id_plateform='.$plateform->getIdPlateform()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('plateform/new') ?>" class="button add">Ajouter une plateforme</a>
