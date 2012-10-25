<h2>Liste des diff&eacute;rents mails</h2>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>Cr&eacute;&eacute; le</th>
      <th>Mis &agrave; jour le</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($mails as $mail): ?>
    <tr>
      <td><?php echo $mail->getName() ?></td>
      <td><?php echo $mail->getDescription() ?></td>
      <td><?php echo $mail->getCreatedAt() ?></td>
      <td><?php echo $mail->getUpdatedAt() ?></td>
      <td><a href="<?php echo url_for('mail/edit?id_mail='.$mail->getIdMail()) ?>">modifier</a> - <a href="<?php echo url_for('mail/testmail?id_mail='.$mail->getIdMail()) ?>">tester</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('mail/new') ?>" class="button">Nouveau mail</a>
  <a href="<?php echo url_for('mail/majEmail') ?>" class="button">mettre &agrave; jour l'email d'expedition</a>