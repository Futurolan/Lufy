<h2>Format des fichiers</h2>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($file_types as $file_type): ?>
    <tr>
      <td><a href="<?php echo url_for('file_type/edit?id_file_type='.$file_type->getIdFileType()) ?>"><?php echo $file_type->getName() ?></a></td>
      <td><?php echo $file_type->getDescription() ?></td>
      <td><a href="<?php echo url_for('file_type/edit?id_file_type='.$file_type->getIdFileType()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-default" href="<?php echo url_for('file_type/new') ?>">Nouveau</a>
