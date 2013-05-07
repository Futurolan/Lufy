<div class="box">
    <div class="title"><?php echo __('Modifier la composition de l equipe')?></div>
    <div class="content">
    <div class="flashbox info">
        <?php echo __('Les gerants sont les seuls a pouvoir modifier les membres d une equipe et en inviter de nouveaux.')?><br/>
        <?php echo __('Attention, un joueur ne peut pas appartenir a plusieurs equipes differentes.')?>
    </div>
        <h4 class="H4Enhance"><?php echo __('Gerants')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil1">
                <?php foreach ($admins as $player): ?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->logourl) { echo '<img src="'.$player->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->country.'.gif', array('height' => '15px'))?>  <?php echo link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?php echo $player->name ?></i>
                            </td>
                            <td>
			<?php echo __('Proprietaire de l equipe')?><br/>
			<?php if ($alreadyInTournament) : ?>
				<?if ($countplayer < $countTournamentPlayer): ?>
			    	<?php echo link_to(image_tag('16/add.png').' '.__('S ajouter en tant que joueur'), 'team/managementIsPlayer?user_id=' . $player->id, array('class' => 'smallbutton')); ?>
				<?php endif; ?>
			<?php else: ?>
				<?php echo link_to(image_tag('16/add.png').' '.__('S ajouter en tant que joueur'), 'team/managementIsPlayer?user_id=' . $player->id, array('class' => 'smallbutton'));?>
			<?php endif; ?>
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
			    <?php if ($alreadyInTournament) : ?>
				<?if ($countplayer < $countTournamentPlayer): ?>
					<?php if ($player->getIsPlayer() != 1) echo link_to(image_tag('16/add.png').' '.__('Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')).'<br/>'; ?>
				<?php endif; ?>
			<?php else: ?>
				<?php if ($player->getIsPlayer() != 1) echo link_to(image_tag('16/add.png').' '.__(' Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')).'<br/>'; ?>
			<?php endif; ?>
			
			<?php if ($player->getIsCaptain() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
			<?php echo link_to(image_tag('16/cancel.png').' '.__('Supprimer'), 'team/deletePlayer?user_id=' . $player->SfGuardUser->id, array('method' => 'delete', 'confirm' => 'Etes vous sur ?','class' => 'smallbutton'));?><br/>
                                    
                            </td>
                        </tr>
                        <?php endif; ?>
                <?php endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?php echo __('Joueurs composant votre equipe')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil2">
                <?php foreach ($joueurs as $player): ?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo $player->SfGuardUser->name ?></i>
                            </td>
                            <td>
                                <?php if ($player->getIsPlayer() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer le joueur'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
                                <?php $u = Doctrine::getTable('sfGuardUser')->IsProprietaire($player->SfGuardUser->id);if ( $u != 1): ?>
                                    <?php if ($player->getIsCaptain() != 1) echo link_to(image_tag('16/add.png').' '.__('Ajouter aux capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')).'<br/>'; ?>
                                <?php endif; ?>
                                <?php if ( $u != 1) echo link_to(image_tag('16/cancel.png').' '.__('Supprimer'), 'team/deletePlayer?user_id=' . $player->SfGuardUser->id, array('method' => 'delete', 'confirm' => 'Etes vous sur ?','class' => 'smallbutton'));?><br/>
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
                            <td>
                                <?php if ($alreadyInTournament) : ?>
				<?if ($countplayer < $countTournamentPlayer): ?>
					<?php if ($player->getIsPlayer() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' Ajouter aux joueurs', 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
				<?php endif; ?>
			<?php else: ?>
				<?php if ($player->getIsPlayer() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
			<?php endif; ?>
				
			<?php if ($player->getIsCaptain() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
			<?php echo link_to(image_tag('16/cancel.png').' '.__('Supprimer'), 'team/deletePlayer?user_id=' . $player->SfGuardUser->id, array('method' => 'delete', 'confirm' => 'Etes vous sur ?','class' => 'smallbutton'));?><br/>
                                    
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </table>

        <br/><br/>
        <?php echo link_to(__('Retourner a la fiche de l equipe'), 'team/index', array('class' => 'button')) ?>
    </div>
</div>
