<?php foreach ($all_tournament as $tournament):?>
    <?php if ($tournament->getPokerTournementId() == $idtournament): ?>
        <div class="flashbox info">
            Vous &ecirc;tes inscrit au tournoi<?php if ($tournament->getIsInvite() == 1) echo " en tant qu'invit&eacute;";?>. <?php echo link_to('Se d&eacute;sinscrire', 'poker_player/delete?id_poker_tournament_player='.$tournament->getIdPokerTournamentPlayer(), array('confirm' => 'La desinscription prendra effet immediatement. Continuer ?'))?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<h4>Liste des joueurs inscrits &agrave; ce tournoi</h4>
<br/>
<table class="listteam" cellspacing="0" cellpadding="5">
    <tr>
        <th>#</th>
        <th>Pseudo Winamax</th>
        <th>Statut</th>
    </tr>
    <?
    $i = 1;
    for ($i; $i<=$reservedslot; $i++):
        ?>
        <tr>
            <td><?php echo $i?></td>
            <td></td>

            <td>R&eacute;serv&eacute;</td>
        </tr>
        <?
    endfor;
    
    foreach ($poker_tournament_players as $player):
        ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $player->getPseudo()?></td>
            <td><?php if ($numberslot >= $i): echo "Inscrit"; else: echo "En attente"; endif;?></td>
        </tr>
        <?
        $i++;
    endforeach; 
    ?>

</table>