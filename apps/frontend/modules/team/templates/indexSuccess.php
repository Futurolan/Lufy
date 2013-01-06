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
    <? if($droits=='1'):?>
        <?=link_to(__('Modifier'), 'team/edit', array('class' => 'button')) ?>
        <?=link_to(__('Supprimer'), 'team/deleteTeam', array('class' => 'button', 'method' => 'delete', 'confirm' => __('Etes vous sur de vouloir definitivement supprimer votre team (historique, place dans le tournoi) ?'))) ?>
    <?endif;?>
    <? if (isset($idTeam)): ?>
        </div>
        <br/><br/>
        <div class="title"><?=__('Composition de l equipe')?></div>
        <div class="content">
        <div class="flashbox info">
        <?=__('Pour valider votre inscription a un tournoi vous devez posseder autant de joueur que necessaire.<br/>
        Les gerants, proprietaire et managers, peuvent modifier la composition d une equipe et inviter de nouveaux joueurs.')?>
        </div>
        <h4 class="H4Enhance"><?=__('Gerants')?> :</h4>
                <table cellspacing="0px" cellpadding="0px" class="profil1">
                <? foreach ($admins as $player): ?>
                        <tr>
                            <td style="width:60px;"><? if ($player->logourl) { echo '<img src="'.$player->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->country.'.png', array('height' => '15px'))?>  <?=link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?=$player->name ?></i>
                            </td>
                        </tr>
                <? endforeach; ?>
                <? foreach ($captains as $player): ?>
                         <? if ($player->SfGuardUser->id != $admins[0]->id):?>
                        <tr>
                            <td><? if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
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
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
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
                                <?=image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?=link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?=$player->SfGuardUser->name ?></i>
                            </td>
                        </tr>
                        <? endif;?>
                <? endforeach; ?>
                </table>

                <br/>
               <br/>
           <? if($droits=='1'):?>
               <?=link_to(__('Gerer la composition de l equipe'), 'team/management', array('class' => 'button'))?>
               <?=link_to(__('Rechercher un joueur'), 'search/user', array('class' => 'button')) ?>
           <? endif; ?>
               <br/><br/><br/>

        <div class="title"><?=__('Tournoi')?></div>
        <?
        if ($alreadyInTournament) {?>
		<table  cellspacing="0px" cellpadding="0px" class="profil4">
            <? foreach($tournaments as $tournament): ?>
               <tr>
	       <td style="width:60px;"><?=image_tag('/uploads/jeux/images/'.$tournament->getTournament()->getGame()->getLogourl(), array('width' => '50px'))?></td>
	       <td><?=link_to($tournament->getTournament()->getName(), 'tournament/view?slug='.$tournament->getTournament()->getSlug()); ?></td>
	       <? if ($b->getStatus() != 'valide'): ?>
	       <td style="width:100px;text-align:right;">
                    <?=link_to('Valider', 'tournament_slot/index',array('class' => 'button')); ?>
	       </td>
	       <td style="width:100px;text-align:right;">
                    <?=link_to('D&eacute;sinscrire', 'tournament_slot/leaveTournament',array('class' => 'button')); ?>
	       </td>	       
		<? endif; ?>
	       
	      </tr>
	    <? endforeach; ?>
            </table>
	   <? 
        }
        else if (!$alreadyInTournament) 
        {
		?>
	    <div class='flashbox info'>
		<?=__('Pour inscrire votre equipe a un tournoi, veuillez cliquer')?> <?=link_to(__('ici'),'tournament/index')?>, <?=__('ou cliquer sur le bouton choisir un tournoi.')?>       
	</div>
          <? if ($tournament_selected): ?>
            <?=link_to(__('Valider mon inscription au tournoi ').$tournament_selected->getName(),"tournament/reglement?slug=".$tournament_selected->getSlug(), array('class' => 'button'))?>
            <?=link_to(__('Changer de tournoi'), "tournament/index", array('class' => 'button'))?>
	    <br/><br/>
	    <i><?=__('L equipe est inscrite a aucun tournoi')?><br/></i> 
          <? endif;
        };
        endif;
    } 
    else {
?> <p>
        <?=__('Vous n appartenez a aucune equipe pour le moment.')?>
        
        <?=__('Deux possibilites s offrent a vous')?> :
		<div class="subtitle"><?=__('Se faire inviter par une equipe')?> :</div>
		<div class="flashbox info"><?=__('Si votre equipe a ete creee par votre manager, indiquez lui votre	pseudo afin qu il vous invite a la rejoindre.')?></div>

		<div class="subtitle"><?=__('Creer votre equipe')?></div>
		<div class="flashbox info"><?=__('Si vous creez une equipe, vous serez le responsable de celle-ci et vous pourrez inviter vos joueurs a la rejoindre.')?></div>


        <br/>
        
    </p>
<?= link_to(__('Creer une equipe'), 'team/new', array('class' => 'button')); ?>
<?= link_to(__('Changer de tournoi'), 'tournament/index', array('class' => 'button')); ?>
  <? } } ?>
</div>
</div>
