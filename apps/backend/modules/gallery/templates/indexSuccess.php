<h2>Galeries photos</h2>

<table class="table">
  <thead>
    <tr>
      <th>Nom</th>
      <th>ID Picasa</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($galleries as $gallery): ?>
    <tr>
      <td><a href="<?php echo url_for('gallery/edit?id_gallery='.$gallery->getIdGallery()) ?>"><?php echo $gallery->getTitle() ?></a></td>
      <td><?php echo $gallery->getAlbumId() ?></td>
      <td></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="button" href="<?php echo url_for('gallery/new') ?>">Nouveau</a>
