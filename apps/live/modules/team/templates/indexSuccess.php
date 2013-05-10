<div class="box">
    <div class="title"><?php echo __('Mon equipe')?></div>
    <div class="content">
    <?php if ($sf_user->isAuthenticated()) { ?>
    <?php if ($team) { ?>
            <h4><?php echo $team->getTeam()->getName()?></h4>
            <table class="profil">
                <tr>
            <td align="center" valign="top" rowspan="5" width="160">
                <?php if ($team->getTeam()->getLogourl()) { echo '<img src="'.$team->getTeam()->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
            </td>
            <th><?php echo __('Nom de l equipe')?></th>
                    <td><?php echo $team->getTeam()->getName()?></td>
                </tr>
                <tr>
                    <th><?php echo __('Tag')?></th>
                    <td><?php echo $team->getTeam()->getTag()?></td>
                </tr>
                <tr>
                    <th><?php echo __('Cree le')?></th>
                    <td><?php echo $team->getTeam()->getCreatedAt()?></td>
                </tr>
                <tr>
                    <th><?php echo __('Site web')?></th>
                    <td><?php echo $team->getTeam()->getWebsite()?></td>
                </tr>
                <tr>
                    <th><?php echo __('Description')?></th>
                    <td><?php echo $team->getTeam()->getDescription()?></td>
                </tr>

        <?php $idTeam = $team->getTeam()->getIdTeam(); ?>
        </table><br/>
    <?php if (isset($idTeam)): ?>
        </div>
        <br/><br/>
        <div class="title"><?php echo __('Composition de l equipe')?></div>
        <div class="content">
        <h4 class="H4Enhance"><?php echo __('Gerants')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil1">
                <?php foreach ($admins as $player): ?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->logourl) { echo '<img src="'.$player->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->country.'.gif', array('height' => '15px'))?>  <?php echo link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?php echo $player->name ?></i>
                            </td>
                        </tr>
                <?php endforeach; ?>
                <?php foreach ($captains as $player): ?>
                         <?php if ($player->SfGuardUser->id != $admins[0]->id):?>
                        <tr>
                            <td><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo $player->SfGuardUser->name ?></i>
                            </td>
                            <td>
                        </tr>
                        <?php endif; ?>
                <?php endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?php echo __('Joueurs composant votre &eacute;quipe')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil2">
                <?php foreach ($joueurs as $player): ?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo $player->SfGuardUser->name ?></i>
                            </td>
                        </tr>
                <?php endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?php echo __('Membres (Non-joueur)')?> :</h4>
                <table  cellspacing="0px" cellpadding="0px" class="profil3">
                <?php foreach ($autres as $player): ?>
                        <?php if ($player->SfGuardUser->id != $admins[0]->id):?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo $player->SfGuardUser->name ?></i>
                            </td>
                        </tr>
                        <?php endif;?>
                <?php endforeach; ?>
                </table>

                <br/>

  <?php endif; }} ?>
</div>
</div>
