<div class="box">
    <div class="title"><?=__('Inscription Tournoi')?></div>

        <div class="flashbox success"><?=__('Votre equipe est inscrite au tournoi')?> <?= link_to($tournamentslot->getTournament(), 'tournament/view?slug=' . $tournamentslot->getTournament()->getSlug()); ?>.</div>

        <? if ($player == '1'):?>
            <p><?=__('En tant que joueur pour cette equipe vous pouvez beneficier d une reduction de 5e sur votre inscription grace a votre licence Masters')?> (<a href="http://mastersjeuvideo.org/page/licences" target="_blank"><?=__('Plus d infos')?></a>).
            <?=__('La reduction est valable uniquement sur les tournois homologues Masters series.')?>
           <? if ($user->getLicenceMasters()):?>
                <? if ($licencetype == 'gold'): ?>
                <p><b><?=__('Vous avez une licence Masters Gold. La reduction est automatiquement prise en compte.')?></b></p>
                <? else: ?>
                    <? if ($licenceused == '1'):?>
                
                        <p><b><?=__('Vous avez deja utilise votre reduction pour un evenement precedant.')?></b></p>
                    <? else :?>
                            <p><b><?=__('Votre reduction pour cet evenement a ete prise en compte.')?></b></p>
                    <?endif;?>
                <? endif; ?>
                <p></p>
            <? else:?>
                <p><?=__('Vous n avez pas entre de licence Masters.')?> <?=link_to(__('Cliquez ici pour gerer vos licences'),'@user_licence') ?></p>
            <?endif;?>

        <? endif ; ?>
        <? if ($droits == '1'):?>
            <div class="flashbox error"><p style="color: red;">
                <b><?=__('Rappel sur la validation')?> :</b>
                <ul>
                    <li>- <?=__('Tous les joueurs de l equipe doivent completer entierement leur profil (champs marques *)')?></li>
                    <li>- <?=__('L equipe doit posseder le nombre de joueur requis pour valider l inscription')?></li>
                    <li>- <?=__('Apres la validation vous ne pourrez plus modifier la composition de votre equipe')?></li>
                </ul>
            </p></div>
            <br/>
            <? if($tournamentslot->getStatus() != 'valide'): ?>
            <p  align="center">
		<? if ($tournamentslot->Tournament->getPlayerPerTeam() > 1) { ?>
		<a href="<?=url_for('team/index')?>" class="button"><?=__('Gerer mon equipe')?></a> 
		<? } ?>
		<a class="button" href="<?= url_for('tournament_slot/leaveTournament'); ?>"><?=__('Vous pouvez vous desinscrire du tournoi en cliquant ici')?></a></p><br/>
            <? endif; ?>
        <? endif ; ?>
    <? if ($tournamentslot->getStatus() == 'inscrit' || $tournamentslot->getStatus() == 'reserve' || $tournamentslot->getStatus() == 'attente'): ?>
            <? if ($payments == 1): ?>
            
             <? if ($commande->isPaypal($commande->getIdCommande()) == '0'): ?>
            <h2><?=__('Votre inscription est en cours de validation')?></h2>
            <p><?=__('Un membre de l equipe a choisis de payer par cheque. A la reception du cheque, un admin validera votre equipe.')?></p>
            <? endif; ?>
            <? elseif ($payments == 0): ?>
                    <div class="flashbox warning">
			<?=__('Votre equipe n a pas encore valide son inscription.')?><br/>
			<?=__('Si vous avez deja envoye un cheque ou paye par Paypal votre validation sera effective dans quelques jours. Un mail de confirmation vous sera envoye.')?>
		    </div>

                    <p>
                        <?=__('La validation de l inscription doit etre effectuee en un seul paiement de')?> <b><?= $pricefinal ?>&euro;</b> (<?=$priceinitial?>&euro; - <?=$reduction?>&euro;) <?=__('pour la totalite de l equipe.')?>
                        <?=__('La validation sera effective au moment de la reception integrale du paiement.')?></p>
                        <br/>

                    <table width="100%">
						<? if($countplayer == $countTournamentPlayer) : ?>
                        <tr><td colspan="2"><?=__('Vous avez le choix entre les deux moyens de paiement suivants')?> : <br/><br/></td></tr>
                        <tr>
                            <td>
                                <a class="button" href="<?= url_for('tournament_slot/cheque'); ?>"><?=__('Paiement par cheque ici')?></a>
                            </td>
                            <td>
                                <a class="button" href="<?= url_for('tournament_slot/paypal'); ?>"><?=__('Paiement par Paypal ici')?></a>

                            </td>
                        </tr>
                       	<? else : ?>
                        	<tr><td colspan="2"><div class="flashbox error"><?=__('Votre equipe n est pas complete')?> (<?=$countplayer; ?>/<?=$countTournamentPlayer; ?>). <?=__('Vous devez completer votre equipe avant de pouvoir faire le paiement.')?></div></td></tr>
                        <? endif; ?>
                    </table>


                    <? endif; ?>
    <? elseif ($tournamentslot->getStatus() == 'valide'): ?>
                        <h2><?=__('Votre equipe a bien valide toutes les etapes de l inscription au tournoi')?></h2>
    <? endif; ?>


</div>
