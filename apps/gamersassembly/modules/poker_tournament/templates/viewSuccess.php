<? use_helper('Date') ?>

<div class="box">
    <h3>Tournoi Poker</h3>
    <table>
        <tr>
            <td valign="top"><?= image_tag('/uploads/jeux/images/poker-winamax.jpg') ?></td>
            <td valign="top">
                <h4><?= $pokerTournament->getName() ?></h4>
                <?=$pokerTournament->getDescription()?><br/><br/>
                D&eacute;but du tournoi le <?=format_datetime($pokerTournament->getStartAt(), 'dd/MM/yyyy à HH:mm')?>
                <br/><br/>
                Le tournois est ouvert pour <?= $pokerTournament->getNumberSlot() ?> joueurs dont <?=$pokerTournament->getSlotReserved()?> invit&eacute;s.<br/><br/>
                La participation aux tournois de poker Winamax est gratuite, cependant vous devrez vous acquittez d'une entr&eacute;e au tarif visiteur.
                <br/><br/>
                <? $maintenant = date("Y-m-d H:i:s"); ?>
                <? if ($event[0]->getStartRegistrationAt() < $maintenant): ?>
                    <? if ($maintenant < $event[0]->getEndRegistrationAt()): ?>
                        <? $check_inscrit = false; ?>
                        <? foreach ($is_inscrit as $tournament):?>
                                <? $check_inscrit = true; ?>
                        <? endforeach; ?>
                        <?if ($check_inscrit == false) echo link_to('Je m\'inscris au tournoi', 'poker_tournament/reglement?slug=' . $pokerTournament->getSlug(), array('class' => 'button')); ?>
                    <? endif; ?>
                <? endif; ?>

                    </td>
                </tr>
            </table>
            <br/><br/>
    <?php include_component('poker_player', 'player', array('idtournament' => $pokerTournament->getIdPokerTournament(), 'numberslot' => $pokerTournament->getNumberSlot(), 'reservedslot' => $pokerTournament->getSlotReserved(), 'iduser' => $user->getId())) ?>
</div>