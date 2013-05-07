<h2>Liste des joueurs</h2>
<?php echo ajax_link(image_tag('/css/img/backend/16excel.png').' Exporter au format Excel 2007', 'user/exportCsv', array('class' => 'button'))?>
<table class="table">
  <thead>
    <tr>
	  <th>#ID</th>
      <th>Prenom Nom (Pseudo)</th>
	  <th>Equipe</th>
      <th>Licence Masters</th>
      <th>Licence GA</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td>#<?php echo $user->getUserId()?></td>
	  <td><?php echo $user->getSfGuardUser()->getName()?> (<?php echo $user->getSfGuardUser()->getUsername()?>)</td>
	  <td><?php echo $user->getTeam()->getName()?></td>
      <td><?php echo $user->getSfGuardUser()->getLicenceMasters()?></td>
      <td><?php echo $user->getSfGuardUser()->getLicenceGa()?></td>
      <td><a href="<?php echo url_for('user/view?user_id='.$user->getUserId())?>">Infos</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>