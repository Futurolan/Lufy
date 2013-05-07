<?php use_helper('Date') ?>

<div class="box">
    <h3>Tournoi Poker</h3>
    <table>
        <tr>
            <td valign="top"><?php echo  image_tag('/uploads/jeux/images/poker-winamax.jpg') ?></td>
            <td valign="top">
                <h4><?php echo  $pokerTournament->getName() ?></h4>
                <?php echo $pokerTournament->getDescription()?><br/><br/>
                D&eacute;but du tournoi le <?php echo format_datetime($pokerTournament->getStartAt(), 'dd/MM/yyyy à HH:mm')?>
                <br/><br/>
                Le tournois est ouvert pour <?php echo  $pokerTournament->getNumberSlot() ?> joueurs dont <?php echo $pokerTournament->getSlotReserved()?> invit&eacute;s.<br/><br/>
                La participation aux tournois de poker Winamax est gratuite, cependant vous devrez vous acquittez d'une entr&eacute;e au tarif visiteur.
                <br/><br/>
                <?php $maintenant = date("Y-m-d H:i:s"); ?>
                <?php if ($event[0]->getStartRegistrationAt() < $maintenant): ?>
                    <?php if ($maintenant < $event[0]->getEndRegistrationAt()): ?>
                        <?php $check_inscrit = false; ?>
                        <?php foreach ($is_inscrit as $tournament):?>
                                <?php $check_inscrit = true; ?>
                        <?php endforeach; ?>
                        <?if ($check_inscrit == false) echo link_to('Je m\'inscris au tournoi', 'poker_tournament/reglement?slug=' . $pokerTournament->getSlug(), array('class' => 'button')); ?>
                    <?php endif; ?>
                <?php endif; ?>

                    </td>
                </tr>
            </table>
            <br/><br/>
    <?php include_component('poker_player', 'player', array('idtournament' => $pokerTournament->getIdPokerTournament(), 'numberslot' => $pokerTournament->getNumberSlot(), 'reservedslot' => $pokerTournament->getSlotReserved(), 'iduser' => $user->getId())) ?>
</div>