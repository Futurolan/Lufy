<div class="box">
    <div class="title"><?php echo __('Fiche equipe')?> - <?php echo $team->getName()?></div>

            <table class="profil">
                <tr>
                    <td align="center" valign="top" rowspan="5" width="160">
                        <?php if ($team->getLogourl()) { echo '<img src="'.$team->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
                    </td>
                    <td><?php echo __('Team')?></td>
                    <td><?php echo  $team->getName() ?></td>
                </tr>
                <tr>
                    <td><?php echo __('Tag')?></td>
                    <td><?php echo  $team->getTag() ?></td>
                </tr>
                <tr>
                    <td><?php echo __('Cree le')?></td>
                    <td><?php echo  $team->getCreatedAt() ?></td>
                </tr>
                <tr>
                    <td><?php echo __('Site web')?></td>
                    <td><?php echo  $team->getWebsite() ?></td>
                </tr>
                <tr>
                    <td><?php echo __('Description')?></td>
                    <td><?php echo  $team->getdescription() ?></td>
                </tr>

        <?php $idTeam = $team['id_team']; ?>
        <?php $players = $team->TeamPlayer; ?>
        </table>

    <?php if (isset($idTeam)): ?>
        <br/><br/>
        <div class="title"><?php echo __('Composition de l equipe')?></div>
               <h4 class="H4Enhance"><?php echo __('Gerants')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil1" style="width: 90%;">
                <?php foreach ($admins as $player): ?>
                        <tr>
                            <td style="width: 60px;"><?php if ($player->logourl) { echo '<img src="'.$player->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->country.'.png', array('height' => '15px'))?>  <?php echo link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?php echo  $player->getFirstName() ?> <?php echo substr($player->getLastName(), 0, 1);?>.</i>
                            </td>
                        </tr>
                <?php endforeach; ?>
                
                <?php $i = 0 ?>
                <?php foreach ($captains as $player): ?>
                    <?php if ($i == 0): ?>
                        <tr>
                    <?php endif; ?>
                    <?php $i++; ?>
                         <?php if ($player->SfGuardUser->id != $admins[0]->id):?>
                            <td style="width: 60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo  $player->getSfGuardUser()->getFirstName() ?> <?php echo substr($player->getSfGuardUser()->getLastName(), 0, 1);?>.</i>
                            </td>
                        <?php if ($i%3 == 0): ?>
                        </tr><tr>
                        <?php endif; ?>
                         <?php endif;?>
                <?php endforeach; ?>
                </table>
                
        <h4 class="H4Enhance"><?php echo __('Joueurs')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil2" style="width: 90%;">               
                <?php $i = 0 ?> 
                <?php foreach ($joueurs as $player): ?>
                    <?php if ($i == 0): ?>
                        <tr>
                    <?php endif; ?>
                    <?php $i++; ?>
                            <td  style="width: 60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo  $player->getSfGuardUser()->getFirstName() ?> <?php echo substr($player->getSfGuardUser()->getLastName(), 0, 1);?>.</i>
                            </td>
                        <?php if ($i%3 == 0): ?>
                        </tr><tr>
                        <?php endif; ?>
                <?php endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?php echo __('Autres')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil3" style="width: 90%;">              
                <?php $i = 0 ?>
                <?php foreach ($autres as $player): ?>
                    <?php if ($i == 0): ?>
                        <tr>
                    <?php endif; ?>
                    <?php $i++; ?>
                    <?php if ($player->SfGuardUser->id != $admins[0]->id):?>
                            <td style="width: 60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo  $player->getSfGuardUser()->getFirstName() ?> <?php echo substr($player->getSfGuardUser()->getLastName(), 0, 1);?>.</i>
                            </td>
                        <?php if ($i%3 == 0): ?>
                        </tr><tr>
                        <?php endif; ?>
                     <?php endif; ?>
                <?php endforeach; ?>
                </table>

                <br/>
               <?php endif; ?>
        <br/><br/>
</div>
