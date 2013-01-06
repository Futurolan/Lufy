<div class="box">
    <div class="title"><?=$tournament->getName()?></div>
    <div class="content">
    <table>
        <tr>
            <td valign="top"><?= image_tag('/uploads/jeux/images/' . $tournament->getGame()->getLogourl()) ?></td>
            <td valign="top">
                <?= $tournament->getGame()->getDescription() ?><br/><br/>
                <?=__('Type')?> : <?= $tournament->getGame()->getGameType() ?><br/>
                <?=__('Editeur')?> : <?= $tournament->getGame()->getEditor() ?><br/>
                <?=__('Plateforme')?> : <?= $tournament->getGame()->getPlateform()->getConstructor() ?> <?= $tournament->getGame()->getPlateform() ?>
                <br/><br/>
                <?=__('Le tournoi se joue par equipe de')?> <?= $tournament->getPlayerPerTeam() ?> <?=__('joueur(s). Les inscriptions sont ouvertes pour')?> <?= $tournament->getNumberTeam() ?> &eacute;quipes.<br/><br/>
                <?=__('Prix d entree (par joueur)')?> : <?= $tournament->getCostPerPlayer() ?> &euro;
                <br/><br/>
                <? $maintenant = date("Y-m-d H:i:s"); ?>
                <? if ($event->getStartRegistrationAt() < $maintenant): ?>
                <? if ($maintenant < $event->getEndRegistrationAt()): ?>
				<? endif; ?>
                <? endif; ?>
                <p><?=__('Les admins de ce tournoi sont')?> :<br/>
                <? foreach($tadmins as $tadmin):?>
                    <a href="<?= url_for('user/view?username=' . $tadmin->getUsername($tadmin->getUserId())) ?>"><?=$tadmin->getUsername($tadmin->getUserId());?></a>
                <? endforeach;?>
                </p>

                    </td>
                </tr>
            </table>
<br/>
    <div class="title"><?=__('Informations')?></div>
            <?=$page->getContent(ESC_RAW)?>
<br/>
    <div class="title"><?=__('Liste des equipes inscrites')?></div>
    <?php include_component('tournament_slot', 'teamAndPlayers', array('idtournament' => $tournament['id_tournament'], 'numberteam' => $tournament['number_team'])) ?>
    </div>
</div>
