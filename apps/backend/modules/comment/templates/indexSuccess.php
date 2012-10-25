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
    <? foreach ($comments as $comment): ?>
    <tr>
      <td><? if ($comment->getStatus() == 1): echo image_tag('/css/img/backend/8green.png'); else: echo image_tag('/css/img/backend/8red.png'); endif;?>      
      <td><?=ajax_link($comment->getNews(), 'news/view?slug='.$comment->getNews()->getSlug()) ?></td>
      <td><?=ajax_link($comment->getSfGuardUser(), 'user/view?username='.$comment->getSfGuardUser()) ?></td>
      <td><?=$comment->getCreatedAt() ?></td>
      <td><a href="<?=url_for('comment/edit?id_comment='.$comment->getIdComment()) ?>">Modifier</a> - 
      <a href="<?=url_for('comment/delete?id_comment='.$comment->getIdComment()) ?>">Supprimer</a></td>
    </tr>
    <? endforeach; ?>
  </tbody>
</table>

  <a href="<?=url_for('comment/new') ?>">Nouveau</a>
