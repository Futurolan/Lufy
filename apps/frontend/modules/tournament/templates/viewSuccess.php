<div class="box">
    <div class="title"><?php echo $tournament->getName()?></div>
    <div class="content">
    <table>
        <tr>
            <td valign="top"><?php echo  image_tag('/uploads/jeux/images/' . $tournament->getGame()->getLogourl()) ?></td>
            <td valign="top">
                <?php echo  $tournament->getGame()->getDescription() ?><br/><br/>
                <?php echo __('Type')?> : <?php echo  $tournament->getGame()->getGameType() ?><br/>
                <?php echo __('Editeur')?> : <?php echo  $tournament->getGame()->getEditor() ?><br/>
                <?php echo __('Plateforme')?> : <?php echo  $tournament->getGame()->getPlateform()->getConstructor() ?> <?php echo  $tournament->getGame()->getPlateform() ?>
                <br/><br/>
                <?php echo __('Le tournoi se joue par equipe de')?> <?php echo  $tournament->getPlayerPerTeam() ?> <?php echo __('joueur(s). Les inscriptions sont ouvertes pour')?> <?php echo  $tournament->getNumberTeam() ?> &eacute;quipes.<br/><br/>
                <?php echo __('Prix d entree (par joueur)')?> : <?php echo  $tournament->getCostPerPlayer() ?> &euro;
                <br/><br/>
                <?php $maintenant = date("Y-m-d H:i:s"); ?>
                <?php if ($event->getStartRegistrationAt() < $maintenant): ?>
                <?php if ($maintenant < $event->getEndRegistrationAt()): ?>
				<?php endif; ?>
                <?php endif; ?>
                <p><?php echo __('Les admins de ce tournoi sont')?> :<br/>
                <?php foreach($tadmins as $tadmin):?>
                    <a href="<?php echo  url_for('user/view?username=' . $tadmin->getUsername($tadmin->getUserId())) ?>"><?php echo $tadmin->getUsername($tadmin->getUserId());?></a>
                <?php endforeach;?>
                </p>

                    </td>
                </tr>
            </table>
<br/>
    <div class="title"><?php echo __('Informations')?></div>
            <?php echo $page->getContent(ESC_RAW)?>
<br/>
    <div class="title"><?php echo __('Liste des equipes inscrites')?></div>
    <?php include_component('tournament_slot', 'teamAndPlayers', array('idtournament' => $tournament['id_tournament'], 'numberteam' => $tournament['number_team'])) ?>
    </div>
</div>
