<div class="box">
    <div class="title"><?=__('Fiche equipe')?> - <?=$team->getName()?></div>

            <table class="profil">
                <tr>
                    <td align="center" valign="top" rowspan="5" width="160">
                        <? if ($team->getLogourl()) { echo '<img src="'.$team->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
                    </td>
                    <td><?=__('Team')?></td>
                    <td><?= $team->getName() ?></td>
                </tr>
                <tr>
                    <td><?=__('Tag')?></td>
                    <td><?= $team->getTag() ?></td>
                </tr>
                <tr>
                    <td><?=__('Cree le')?></td>
                    <td><?= $team->getCreatedAt() ?></td>
                </tr>
                <tr>
                    <td><?=__('Site web')?></td>
                    <td><?= $team->getWebsite() ?></td>
                </tr>
                <tr>
                    <td><?=__('Description')?></td>
                    <td><?= $team->getdescription() ?></td>
                </tr>

        <? $idTeam = $team['id_team']; ?>
        <? $players = $team->TeamPlayer; ?>
        </table>

    <? if (isset($idTeam)): ?>
        <br/><br/>
        <div class="title"><?=__('Composition de l equipe')?></div>
               <h4 class="H4Enhance"><?=__('Gerants')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil1" style="width: 90%;">
                <? foreach ($admins as $player): ?>
                        <tr>
                            <td style="width: 60px;"><? if ($player->logourl) { echo '<img src="'.$player->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->country.'.png', array('height' => '15px'))?>  <?=link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?= $player->getFirstName() ?> <?=substr($player->getLastName(), 0, 1);?>.</i>
                            </td>
                        </tr>
                <? endforeach; ?>
                
                <? $i = 0 ?>
                <? foreach ($captains as $player): ?>
                    <? if ($i == 0): ?>
                        <tr>
                    <? endif; ?>
                    <? $i++; ?>
                         <? if ($player->SfGuardUser->id != $admins[0]->id):?>
                            <td style="width: 60px;"><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?= $player->getSfGuardUser()->getFirstName() ?> <?=substr($player->getSfGuardUser()->getLastName(), 0, 1);?>.</i>
                            </td>
                        <? if ($i%3 == 0): ?>
                        </tr><tr>
                        <? endif; ?>
                         <? endif;?>
                <? endforeach; ?>
                </table>
                
        <h4 class="H4Enhance"><?=__('Joueurs')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil2" style="width: 90%;">               
                <? $i = 0 ?> 
                <? foreach ($joueurs as $player): ?>
                    <? if ($i == 0): ?>
                        <tr>
                    <? endif; ?>
                    <? $i++; ?>
                            <td  style="width: 60px;"><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?= $player->getSfGuardUser()->getFirstName() ?> <?=substr($player->getSfGuardUser()->getLastName(), 0, 1);?>.</i>
                            </td>
                        <? if ($i%3 == 0): ?>
                        </tr><tr>
                        <? endif; ?>
                <? endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?=__('Autres')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil3" style="width: 90%;">              
                <? $i = 0 ?>
                <? foreach ($autres as $player): ?>
                    <? if ($i == 0): ?>
                        <tr>
                    <? endif; ?>
                    <? $i++; ?>
                    <? if ($player->SfGuardUser->id != $admins[0]->id):?>
                            <td style="width: 60px;"><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?= $player->getSfGuardUser()->getFirstName() ?> <?=substr($player->getSfGuardUser()->getLastName(), 0, 1);?>.</i>
                            </td>
                        <? if ($i%3 == 0): ?>
                        </tr><tr>
                        <? endif; ?>
                     <? endif; ?>
                <? endforeach; ?>
                </table>

                <br/>
               <? endif; ?>
        <br/><br/>
</div>
