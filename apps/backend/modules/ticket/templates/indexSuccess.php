<h2>Tickets</h2>

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Sujet</th>
      <th>Soumis par</th>
      <th>Assign&eacute; &agrave;</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tickets as $ticket): ?>
    <tr>
      <td><a href="<?php echo url_for('ticket/edit?id='.$ticket->getId()) ?>"><?=$ticket->getId()?></a></td>
      <td><?=$ticket->getTitle() ?></td>
      <td><?=$ticket->getSfGuardUser() ?></td>
      <td><?=$ticket->getOwner() ?></td>
      <td><a href="<?php echo url_for('ticket/view?id='.$ticket->getId()) ?>">Voir le suivis du ticket</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('ticket/new') ?>" class="btn btn-default add">Cr&eacute;er un ticket</a>
