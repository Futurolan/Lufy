<h2>Cat&eacute;gorie de fichier</h2>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($file_categorys as $file_category): ?>
    <tr>
      <td><a href="<?php echo url_for('file_category/edit?id_file_category='.$file_category->getIdFileCategory()) ?>"><?php echo $file_category->getName() ?></a></td>
      <td><?php echo $file_category->getDescription() ?></td>
      <td><a href="<?php echo url_for('file_category/edit?id_file_category='.$file_category->getIdFileCategory()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="button" href="<?php echo url_for('file_category/new') ?>">Nouveau</a>
