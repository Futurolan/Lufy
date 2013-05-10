<h2>Fiche joueur</h2>

<table class="table">
    <tr>
        <th>Nom</th>
        <td><?php echo $player->getSfGuardUser()->getLastName()?></td>
    </tr>
    <tr>
        <th>Pr&eacute;nom</th>
        <td><?php echo $player->getSfGuardUser()->getFirstName()?></td>
    </tr>
    <tr>
        <th>Pseudo</th>
        <td><?php echo $player->getSfGuardUser()->getUsername()?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?php echo $player->getSfGuardUser()->getEmailAddress()?></td>
    </tr>
    <tr>
        <th>Licence Masters</th>
        <td><?php echo $player->getSfGuardUser()->getLicenceMasters()?></td>
    </tr>
    <tr>
        <th>Licence GA</th>
        <td><?php echo $player->getSfGuardUser()->getLicenceGa()?></td>
    </tr>
    <tr>
        <th>Equipe</th>
        <td><?php echo ajax_link($player->getTeam(), 'team/view?id_team='.$player->getTeam()->getIdTeam())?></td>
    </tr>
    <tr>
        <th>Statuts</th>
        <td>
            <?php if ($player->getIsPlayer() == 1) echo image_tag('32/player.png', array('title' => 'Joueur')); 
            else echo image_tag('32/no-player.png', array('title' => 'Non joueur')); ?> - 
            <?php if ($player->getIsCaptain() == 1) echo image_tag('32/manager.png', array('title' => 'Manager')); 
            else echo image_tag('32/no-player.png', array('title' => 'Non manager'));?> - 
            <?php if ($player->getTeam()->getAdminteamId() == $player->getUserId()) echo image_tag('32/adminteam.png', array('title' => 'Administrateur')); 
            else echo image_tag('32/no-player.png', array('title' => 'Non administrateur'));?>
        </td>
    </tr>
    <tr>
        <th>Adresse</th>
        <td>
            <?php echo $player->getSfGuardUser()->getAddress()?><br/>
            <?php echo $player->getSfGuardUser()->getZipcode()?> <?php echo $player->getSfGuardUser()->getCity()?><br/>
            <?php echo $player->getSfGuardUser()->getCountry()?>
        </td>
    </tr>
    <tr>
        <th>Telephone</th>
        <td><?php echo $player->getSfGuardUser()->getPhone()?></td>
    </tr>
    <tr>
        <th>Naissance</th>
        <td><?php echo $player->getSfGuardUser()->getBirthdate()?></td>
    </tr>
</table>
<a class="button" href="<?php echo url_for('user/setCaptain?user_id='.$player->getUserId())?>">D&eacute;finir comme capitaine</a>
<a class="button" href="<?php echo url_for('user/setPlayer?user_id='.$player->getUserId())?>">D&eacute;finir comme joueur</a>
<a class="button" href="<?php echo url_for('user/verifMasters?id='.$player->getUserId())?>">V&eacute;rifier licence Masters</a><br/><br/>
<a class="button" href="../../../guard/users/<?php echo $player->getUserId()?>/edit">Modifier joueur</a>
<a class="button" href="<?php echo url_for('team/edit?id_team='.$player->getTeam()->getIdTeam())?>">Modifier &eacute;quipe</a>
<?php if ( $notactive == true ):?>
    <a class="button" href="<?php echo url_for('user/sendActivation?id='.$player->getUserId())?>">Renvoyer le mail d'activation de compte</a>
<?php endif; ?>

