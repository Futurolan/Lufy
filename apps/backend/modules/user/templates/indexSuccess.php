<h2>Liste des joueurs</h2>
<?=link_to(image_tag('/css/img/backend/16excel.png').' Exporter au format Excel 2007', 'user/exportCsv', array('class' => 'btn btn-default'))?>
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
    <? foreach ($users as $user): ?>
    <tr>
      <td>#<?=$user->getUserId()?></td>
	  <td><?=$user->getSfGuardUser()->getName()?> (<?=$user->getSfGuardUser()->getUsername()?>)</td>
	  <td><?=$user->getTeam()->getName()?></td>
      <td><?=$user->getSfGuardUser()->getSfGuardUserLicenceMasters()->getSerial()?></td>
      <td><?=$user->getSfGuardUser()->getSfGuardUserProfile()->getEAN13()?></td>
      <td><a href="<?=url_for('user/view?user_id='.$user->getUserId())?>">Infos</a></td>
    </tr>
    <? endforeach; ?>
  </tbody>
</table>