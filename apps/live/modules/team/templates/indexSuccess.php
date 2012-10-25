<div class="box">
    <div class="title"><?=__('Mon equipe')?></div>
    <div class="content">
    <? if ($sf_user->isAuthenticated()) { ?>
    <? if ($team) { ?>
            <h4><?=$team->getTeam()->getName()?></h4>
            <table class="profil">
                <tr>
            <td align="center" valign="top" rowspan="5" width="160">
                <? if ($team->getTeam()->getLogourl()) { echo '<img src="'.$team->getTeam()->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
            </td>
            <th><?=__('Nom de l equipe')?></th>
                    <td><?=$team->getTeam()->getName()?></td>
                </tr>
                <tr>
                    <th><?=__('Tag')?></th>
                    <td><?=$team->getTeam()->getTag()?></td>
                </tr>
                <tr>
                    <th><?=__('Cree le')?></th>
                    <td><?=$team->getTeam()->getCreatedAt()?></td>
                </tr>
                <tr>
                    <th><?=__('Site web')?></th>
                    <td><?=$team->getTeam()->getWebsite()?></td>
                </tr>
                <tr>
                    <th><?=__('Description')?></th>
                    <td><?=$team->getTeam()->getDescription()?></td>
                </tr>

        <? $idTeam = $team->getTeam()->getIdTeam(); ?>
        </table><br/>
    <? if (isset($idTeam)): ?>
        </div>
        <br/><br/>
        <div class="title"><?=__('Composition de l equipe')?></div>
        <div class="content">
        <h4 class="H4Enhance"><?=__('Gerants')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil1">
                <? foreach ($admins as $player): ?>
                        <tr>
                            <td style="width:60px;"><? if ($player->logourl) { echo '<img src="'.$player->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->country.'.gif', array('height' => '15px'))?>  <?=link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?=$player->name ?></i>
                            </td>
                        </tr>
                <? endforeach; ?>
                <? foreach ($captains as $player): ?>
                         <? if ($player->SfGuardUser->id != $admins[0]->id):?>
                        <tr>
                            <td><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?=$player->SfGuardUser->name ?></i>
                            </td>
                            <td>
                        </tr>
                        <? endif; ?>
                <? endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?=__('Joueurs composant votre &eacute;quipe')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil2">
                <? foreach ($joueurs as $player): ?>
                        <tr>
                            <td style="width:60px;"><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?=$player->SfGuardUser->name ?></i>
                            </td>
                        </tr>
                <? endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?=__('Membres (Non-joueur)')?> :</h4>
                <table  cellspacing="0px" cellpadding="0px" class="profil3">
                <? foreach ($autres as $player): ?>
                        <? if ($player->SfGuardUser->id != $admins[0]->id):?>
                        <tr>
                            <td style="width:60px;"><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?=$player->SfGuardUser->name ?></i>
                            </td>
                        </tr>
                        <? endif;?>
                <? endforeach; ?>
                </table>

                <br/>

  <? endif; }} ?>
</div>
</div>
