<h2>Tous les commentaires</h2>

<table class="table">
  <thead>
    <tr>
      <th></th>
      <th>News</th>
      <th>Auteur</th>
      <th>Post&eacute; le</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($comments as $comment): ?>
    <tr>
      <td><?php if ($comment->getStatus() == 1): echo image_tag('/css/img/backend/8green.png'); else: echo image_tag('/css/img/backend/8red.png'); endif;?>      
      <td><?php echo ajax_link($comment->getNews(), 'news/view?slug='.$comment->getNews()->getSlug()) ?></td>
      <td><?php echo ajax_link($comment->getSfGuardUser(), 'user/view?username='.$comment->getSfGuardUser()) ?></td>
      <td><?php echo $comment->getCreatedAt() ?></td>
      <td><a href="<?php echo url_for('comment/edit?id_comment='.$comment->getIdComment()) ?>">Modifier</a> - 
      <a href="<?php echo url_for('comment/delete?id_comment='.$comment->getIdComment()) ?>">Supprimer</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('comment/new') ?>">Nouveau</a>
