<h2>Fiche joueur</h2>

<table class="table">
  <tr>
    <th>Nom</th>
    <td><?= $player->getSfGuardUser()->getLastName() ?></td>
  </tr>
  <tr>
    <th>Pr&eacute;nom</th>
    <td><?= $player->getSfGuardUser()->getFirstName() ?></td>
  </tr>
  <tr>
    <th>Pseudo</th>
    <td><?= $player->getSfGuardUser()->getUsername() ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?= $player->getSfGuardUser()->getEmailAddress() ?></td>
  </tr>
  <tr>
    <th>Licence Masters</th>
    <td><?= $player->getSfGuardUser()->getSfGuardUserLicenceMasters()->getSerial(); echo 'toto'; ?></td>
  </tr>
  <tr>
    <th>Licence GA</th>
    <td><?= $player->getSfGuardUser()->getSfGuardUserProfile()->getEAN13() ?></td>
  </tr>
  <tr>
    <th>Equipe</th>
    <td><?= link_to($player->getTeam(), 'team/view?id_team=' . $player->getTeam()->getIdTeam()) ?></td>
  </tr>
  <tr>
    <th>Statuts</th>
    <td>
      <? if ($player->getIsPlayer() == 1)
        echo image_tag('32/player.png', array('title' => 'Joueur'));
      else
        echo image_tag('32/no-player.png', array('title' => 'Non joueur'));
      ?> - 
<? if ($player->getIsCaptain() == 1)
  echo image_tag('32/manager.png', array('title' => 'Manager'));
else
  echo image_tag('32/no-player.png', array('title' => 'Non manager'));
?>
    </td>
  </tr>
  <tr>
    <th>Adresse</th>
    <td>
<?php
foreach ($player->getSfGuardUser()->getSfGuardUserAddress() as $key => $value)
{
 echo $key;
 echo $value;
}
?>



<? //Afficher toutes les adresses =$player->getSfGuardUser()->getAddress() ?><br/>
<? //=$player->getSfGuardUser()->getZipcode() ?> <? //=$player->getSfGuardUser()->getCity() ?><br/>
<? //=$player->getSfGuardUser()->getCountry() ?>
    </td>
  </tr>
  <tr>
    <th>Telephone</th>
    <td><?= $player->getSfGuardUser()->getSfGuardUserProfile()->getPhone() ?></td>
  </tr>
  <tr>
    <th>Naissance</th>
    <td><?= $player->getSfGuardUser()->getSfGuardUserProfile()->getBirthdate() ?></td>
  </tr>
</table>
<!-- <a class="btn btn-default" href="<?//= url_for('user/setCaptain?user_id=' . $player->getUserId()) ?>">D&eacute;finir comme capitaine</a>
<a class="btn btn-default" href="<?//= url_for('user/setPlayer?user_id=' . $player->getUserId()) ?>">D&eacute;finir comme joueur</a>
<a class="btn btn-default" href="<?//= url_for('user/verifMasters?id=' . $player->getUserId()) ?>">V&eacute;rifier licence Masters</a><br/><br/>
<a class="btn btn-default" href="../../../guard/users/<?//=$player->getUserId() ?>/edit">Modifier joueur</a>-->
<? if ($notactive == true): ?>
  <a class="btn btn-default" href="<?= url_for('user/sendActivation?id=' . $player->getUserId()) ?>">Renvoyer le mail d'activation de compte</a>
<? endif; ?>

