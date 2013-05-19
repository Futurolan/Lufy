<h2><?php echo __('Mon equipe')?></h2>

<?php if ($team) { ?>

  <h3><?php echo $team->getTeam()->getName()?></h3>
  <table class="table">
    <tr>
      <td align="center" valign="top" rowspan="6" width="160">
        <?php if ($team->getTeam()->getLogourl()) { echo '<img src="'.$team->getTeam()->getLogourl().'" width="150">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '150')); }?><br/><br/>
      </td>
    </tr>
    <tr>
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
  </table>

  <?php $idTeam = $team->getTeam()->getIdTeam(); ?>

  <?php if($droits=='1'):?>
    <?php echo link_to('<i class="icon-pencil"></i> '.__('Modifier'), 'team/edit', array('class' => 'btn')) ?>
    <?php echo link_to('<i class="icon-remove"></i> '.__('Supprimer'), 'team/deleteTeam', array('class' => 'btn btn-danger', 'method' => 'delete', 'confirm' => __('Etes vous sur de vouloir definitivement supprimer votre team (historique, place dans le tournoi) ?'))) ?>
  <?php endif; ?>

  <?php if (isset($idTeam)): ?>

  <h2><?php echo __('Composition de l equipe')?></h2>
  <div class="alert alert-info">
    <?php echo __('Les fondateurs et managers, peuvent modifier la composition d une equipe et inviter de nouveaux joueurs.')?>
  </div>

  <h3><?php echo __('Gerants')?></h3>
  <table cellspacing="0px" cellpadding="0px">
  <?php foreach ($admins as $player): ?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->getSfGuardUserProfile()->getLogourl()) { echo '<img src="'.$player->getSfGuardUserProfile()->getLogourl().'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo link_to($player->username, 'user/view?username='.$player->username) ?><br/>
                                <i><?php echo $player->name ?></i>
                            </td>
                        </tr>
                <?php endforeach; ?>
                <?php foreach ($captains as $player): ?>
                         <?php if ($player->SfGuardUser->id != $admins[0]->id):?>
                        <tr>
                            <td><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo $player->SfGuardUser->name ?></i>
                            </td>
                            <td>
                        </tr>
                        <?php endif; ?>
                <?php endforeach; ?>
                </table>
        <h3><?php echo __('Joueurs')?></h3>
                <table cellspacing="0px" cellpadding="0px" class="profil2">
                <?php foreach ($joueurs as $player): ?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo $player->SfGuardUser->name ?></i>
                            </td>
                        </tr>
                <?php endforeach; ?>
                </table>
        <h3><?php echo __('Membres non joueur')?></h3>
                <table  cellspacing="0px" cellpadding="0px" class="profil3">
                <?php foreach ($autres as $player): ?>
                        <?php if ($player->SfGuardUser->id != $admins[0]->id):?>
                        <tr>
                            <td style="width:60px;"><?php if ($player->SfGuardUser->logourl) { echo '<img src="'.$player->SfGuardUser->logourl.'" width="50">'; } else { echo image_tag('/uploads/profils/no-profil.png', array('width' => '50')); }?> </td>
                            <td>
                                <?php echo image_tag('/css/img/flag/'.$player->SfGuardUser->country.'.png', array('height' => '15px'))?>  <?php echo link_to($player->SfGuardUser->username, 'user/view?username='.$player->SfGuardUser->username) ?><br/>
                                <i><?php echo $player->SfGuardUser->name ?></i>
                            </td>
                        </tr>
                        <?php endif;?>
                <?php endforeach; ?>
                </table>

                <br/>
               <br/>
           <?php if($droits=='1'):?>
               <?php echo link_to(__('Modifier la composition'), 'team/management', array('class' => 'btn'))?>
               <?php echo link_to(__('Rechercher un joueur'), 'search/user', array('class' => 'btn')) ?>
           <?php endif; ?>
               <br/><br/><br/>

        <h2><?php echo __('Tournoi')?></h2>
        <?
        if ($alreadyInTournament) {?>
		<table  cellspacing="0px" cellpadding="0px" class="profil4">
            <?php foreach($tournaments as $tournament): ?>
               <tr>
	       <td style="width:60px;"><?php echo image_tag('/uploads/jeux/images/'.$tournament->getTournament()->getGame()->getLogourl(), array('width' => '50px'))?></td>
	       <td><?php echo link_to($tournament->getTournament()->getName(), 'tournament/view?slug='.$tournament->getTournament()->getSlug()); ?></td>
	       <?php if ($b->getStatus() != 'valide'): ?>
	       <td style="width:100px;text-align:right;">
                    <?php echo link_to('Valider', 'tournament_slot/index',array('class' => 'button')); ?>
	       </td>
	       <td style="width:100px;text-align:right;">
                    <?php echo link_to('D&eacute;sinscrire', 'tournament_slot/leaveTournament',array('class' => 'button')); ?>
	       </td>
		<?php endif; ?>
	      </tr>
	    <?php endforeach; ?>
            </table>
	   <?php 
        }
        else if (!$alreadyInTournament) 
        {
		?>
	    <div class='flashbox info'>
		<?php echo __('Pour inscrire votre equipe a un tournoi, veuillez cliquer')?> <?php echo link_to(__('ici'),'tournament/index')?>, <?php echo __('ou cliquer sur le bouton choisir un tournoi.')?>       
	</div>
          <?php if ($tournament_selected): ?>
            <?php echo link_to(__('Valider mon inscription au tournoi ').$tournament_selected->getName(),"tournament/reglement?slug=".$tournament_selected->getSlug(), array('class' => 'button'))?>
            <?php echo link_to(__('Changer de tournoi'), "tournament/index", array('class' => 'button'))?>
	    <br/><br/>
	    <i><?php echo __('L equipe est inscrite a aucun tournoi')?><br/></i> 
          <?php endif;
        };
        endif;
    } 
    else {
?> <p>
        <?php echo __('Vous n appartenez a aucune equipe pour le moment.')?>

        <?php echo __('Deux possibilites s offrent a vous')?> :
		<div class="subtitle"><?php echo __('Se faire inviter par une equipe')?> :</div>
		<div class="flashbox info"><?php echo __('Si votre equipe a ete creee par votre manager, indiquez lui votre	pseudo afin qu il vous invite a la rejoindre.')?></div>

		<div class="subtitle"><?php echo __('Creer votre equipe')?></div>
		<div class="flashbox info"><?php echo __('Si vous creez une equipe, vous serez le responsable de celle-ci et vous pourrez inviter vos joueurs a la rejoindre.')?></div>


        <br/>
    </p>
<?php echo  link_to('<i class="icon-plus"></i> '.__('Creer une equipe'), 'team/new', array('class' => 'btn')); ?>
<?php echo  link_to('<i class="icon-rotate-right"></i> '.__('Changer de tournoi'), 'tournament/index', array('class' => 'btn')); ?>
  <?php }  ?>
