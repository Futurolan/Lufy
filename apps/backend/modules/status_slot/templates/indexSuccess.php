<h1>Status slots List</h1>

<table>
  <thead>
    <tr>
      <th>Id status slot</th>
      <th>Name</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($status_slots as $status_slot): ?>
    <tr>
      <td><a href="<?php echo url_for('status_slot/edit?id_status_slot='.$status_slot->getIdStatusSlot()) ?>"><?php echo $status_slot->getIdStatusSlot() ?></a></td>
      <td><?php echo $status_slot->getName() ?></td>
      <td><?php echo $status_slot->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('status_slot/new') ?>">New</a>
