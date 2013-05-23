<? use_helper('Date') ?>
<h2>&Eacute;v&egrave;nements</h2>

<table class="table">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Date d'inscriptions</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/edit?id_event='.$event->getIdEvent()) ?>"><?php echo $event->getName() ?></a></td>
      <td>Du <?php echo format_date($event->getStartRegistrationAt(), 'D', 'fr') ?> au <?php echo format_date($event->getEndRegistrationAt(), 'D', 'fr') ?></td>
      <td><a href="<?php echo url_for('event/edit?id_event='.$event->getIdEvent()) ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('event/new') ?>" class="button">Nouveau</a>
