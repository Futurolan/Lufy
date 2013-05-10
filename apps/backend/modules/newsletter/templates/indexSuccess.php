<h1>Liste des Newsletter</h1>

<table class="table">
  <thead>
    <tr>
      <th>Titre</th>
      <th>Destinataires</th>
      <th>Cr&eacute;&eacute; le</th>
      <th>Modifi&eacute; le</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($newsletters as $newsletter): ?>
    <tr>
      <td><?php echo $newsletter->getSubject() ?></td>
      <td><?php echo $newsletter->getRecipient() ?></td>
      <td><?php echo $newsletter->getCreatedAt() ?></td>
      <td><?php echo $newsletter->getUpdatedAt() ?></td>
      <td><a href="<?php echo url_for('newsletter/edit?id_newsletter='.$newsletter->getIdNewsletter()) ?>">Modifier</a> - <a href="<?php echo url_for('newsletter/publish?id_newsletter='.$newsletter->getIdNewsletter()) ?>">Diffuser</a></td>

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('newsletter/new') ?>">Cr&eacute;er une newsletter</a>
