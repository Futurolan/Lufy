<div class="box">
    <div class="title"><?=__('Modifier la composition de l equipe')?></div>
    <div class="content">
    <div class="flashbox info">
        <?=__('Les gerants sont les seuls a pouvoir modifier les membres d une equipe et en inviter de nouveaux.')?><br/>
        <?=__('Attention, un joueur ne peut pas appartenir a plusieurs equipes differentes.')?>
    </div>
        <h4 class="H4Enhance"><?=__('Gerants')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil1">
                <? foreach ($admins as $player): ?>
                        <tr>
                            <td style="width:60px;"><? if ($player->logourl) { echo '<img src="'.$player->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->country.'.gif', array('height' => '15px'))?>  <?=link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?=$player->name ?></i>
                            </td>
                            <td>
			<?=__('Proprietaire de l equipe')?><br/>
			<? if ($alreadyInTournament) : ?>
				<?if ($countplayer < $countTournamentPlayer): ?>
			    	<? echo link_to(image_tag('16/add.png').' '.__('S ajouter en tant que joueur'), 'team/managementIsPlayer?user_id=' . $player->id, array('class' => 'smallbutton')); ?>
				<? endif; ?>
			<? else: ?>
				<? echo link_to(image_tag('16/add.png').' '.__('S ajouter en tant que joueur'), 'team/managementIsPlayer?user_id=' . $player->id, array('class' => 'smallbutton'));?>
			<? endif; ?>
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
			    <? if ($alreadyInTournament) : ?>
				<?if ($countplayer < $countTournamentPlayer): ?>
					<? if ($player->getIsPlayer() != 1) echo link_to(image_tag('16/add.png').' '.__('Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')).'<br/>'; ?>
				<? endif; ?>
			<? else: ?>
				<? if ($player->getIsPlayer() != 1) echo link_to(image_tag('16/add.png').' '.__(' Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')).'<br/>'; ?>
			<? endif; ?>
			
			<? if ($player->getIsCaptain() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
			<? echo link_to(image_tag('16/cancel.png').' '.__('Supprimer'), 'team/deletePlayer?user_id=' . $player->SfGuardUser->id, array('method' => 'delete', 'confirm' => 'Etes vous sur ?','class' => 'smallbutton'));?><br/>
                                    
                            </td>
                        </tr>
                        <? endif; ?>
                <? endforeach; ?>
                </table>
        <h4 class="H4Enhance"><?=__('Joueurs composant votre equipe')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil2">
                <? foreach ($joueurs as $player): ?>
                        <tr>
                            <td style="width:60px;"><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.gif', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?=$player->SfGuardUser->name ?></i>
                            </td>
                            <td>
                                <? if ($player->getIsPlayer() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer le joueur'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
                                <? $u = Doctrine::getTable('sfGuardUser')->IsProprietaire($player->SfGuardUser->id);if ( $u != 1): ?>
                                    <? if ($player->getIsCaptain() != 1) echo link_to(image_tag('16/add.png').' '.__('Ajouter aux capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')).'<br/>'; ?>
                                <? endif; ?>
                                <? if ( $u != 1) echo link_to(image_tag('16/cancel.png').' '.__('Supprimer'), 'team/deletePlayer?user_id=' . $player->SfGuardUser->id, array('method' => 'delete', 'confirm' => 'Etes vous sur ?','class' => 'smallbutton'));?><br/>
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
                            <td>
                                <? if ($alreadyInTournament) : ?>
				<?if ($countplayer < $countTournamentPlayer): ?>
					<? if ($player->getIsPlayer() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' Ajouter aux joueurs', 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
				<? endif; ?>
			<? else: ?>
				<? if ($player->getIsPlayer() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux joueurs'), 'team/managementIsPlayer?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
			<? endif; ?>
				
			<? if ($player->getIsCaptain() == 1) echo link_to(image_tag('16/delete.png').' '.__('Retirer des capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); else echo link_to(image_tag('16/add.png').' '.__('Ajouter aux capitaines'), 'team/managementIsCaptain?user_id=' . $player->SfGuardUser->id, array('class' => 'smallbutton')); ?><br/>
			<? echo link_to(image_tag('16/cancel.png').' '.__('Supprimer'), 'team/deletePlayer?user_id=' . $player->SfGuardUser->id, array('method' => 'delete', 'confirm' => 'Etes vous sur ?','class' => 'smallbutton'));?><br/>
                                    
                            </td>
                        </tr>
                    <? endif; ?>
                <? endforeach; ?>
                </table>

        <br/><br/>
        <?=link_to(__('Retourner a la fiche de l equipe'), 'team/index', array('class' => 'button')) ?>
    </div>
</div>
