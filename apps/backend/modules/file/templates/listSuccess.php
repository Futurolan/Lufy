<h2>Galeries > <?=$file_category->getName()?></h2>

<table class="table">
  <thead>
      <th></th>
      <th>Nom</th>
      <th>Clef</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($files as $file): ?>
    <tr>
      <td><? if ($file->status == 1): echo image_tag('/css/img/backend/8green.png'); else: echo image_tag('/css/img/backend/8red.png'); endif;?></td>
      <td><a href="<?php echo url_for('file/edit?id_file='.$file->getIdFile()) ?>"><?php echo $file->getName() ?></a></td>
      <td><a href="http://www.dailymotion.com/video/<?=$file->file?>" target="_blank"><?php echo $file->getFile() ?></a></td>
      <td><?php echo $file->getFileType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="button" href="<?php echo url_for('file/new') ?>">Ajouter une vid&eacute;o</a>

