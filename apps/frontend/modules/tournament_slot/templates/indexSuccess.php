<div class="box">
    <div class="title"><?php echo __('Inscription Tournoi')?></div>

        <div class="flashbox success"><?php echo __('Votre equipe est inscrite au tournoi')?> <?php echo  link_to($tournamentslot->getTournament(), 'tournament/view?slug=' . $tournamentslot->getTournament()->getSlug()); ?>.</div>

        <?php if ($player == '1'):?>
            <p><?php echo __('En tant que joueur pour cette equipe vous pouvez beneficier d une reduction de 5e sur votre inscription grace a votre licence Masters')?> (<a href="http://mastersjeuvideo.org/page/licences" target="_blank"><?php echo __('Plus d infos')?></a>).
            <?php echo __('La reduction est valable uniquement sur les tournois homologues Masters series.')?>
           <?php if ($user->getLicenceMasters()):?>
                <?php if ($licencetype == 'gold'): ?>
                <p><b><?php echo __('Vous avez une licence Masters Gold. La reduction est automatiquement prise en compte.')?></b></p>
                <?php else: ?>
                    <?php if ($licenceused == '1'):?>

                        <p><b><?php echo __('Vous avez deja utilise votre reduction pour un evenement precedant.')?></b></p>
                    <?php else :?>
                            <p><b><?php echo __('Votre reduction pour cet evenement a ete prise en compte.')?></b></p>
                    <?endif;?>
                <?php endif; ?>
                <p></p>
            <?php else:?>
                <p><?php echo __('Vous n avez pas entre de licence Masters.')?> <?php echo link_to(__('Cliquez ici pour gerer vos licences'),'@user_licence') ?></p>
            <?endif;?>

        <?php endif ; ?>
        <?php if ($droits == '1'):?>
            <div class="flashbox error"><i style="color: red;">
                <b><?php echo __('Rappel sur la validation')?> :</b>
                <ul>
                    <li>- <?php echo __('Tous les joueurs de l equipe doivent completer entierement leur profil (champs marques *)')?></li>
                    <li>- <?php echo __('L equipe doit posseder le nombre de joueur requis pour valider l inscription')?></li>
                    <li>- <?php echo __('Apres la validation vous ne pourrez plus modifier la composition de votre equipe')?></li>
                </ul>
            </p></div>
            <br/>
            <?php if($tournamentslot->getStatus() != 'valide'): ?>
            <p  align="center">
		<?php if ($tournamentslot->Tournament->getPlayerPerTeam() > 1) { ?>
		<a href="<?php echo url_for('team/index')?>" class="button"><?php echo __('Gerer mon equipe')?></a>
		<?php } ?>
		<a class="button" href="<?php echo  url_for('tournament_slot/leaveTournament'); ?>"><?php echo __('Vous pouvez vous desinscrire du tournoi en cliquant ici')?></a></p><br/>
            <?php endif; ?>
        <?php endif ; ?>
    <?php if ($tournamentslot->getStatus() == 'inscrit' || $tournamentslot->getStatus() == 'reserve' || $tournamentslot->getStatus() == 'attente'): ?>
            <?php if ($payments == 1): ?>

             <?php if ($commande->isPaypal($commande->getIdCommande()) == '0'): ?>
            <h2><?php echo __('Votre inscription est en cours de validation')?></h2>
            <p><?php echo __('Un membre de l equipe a choisis de payer par cheque. A la reception du cheque, un admin validera votre equipe.')?></p>
            <?php endif; ?>
            <?php elseif ($payments == 0): ?>
                    <div class="flashbox warning">
			<?php echo __('Votre equipe n a pas encore valide son inscription.')?><br/>
			<?php echo __('Si vous avez deja envoye un cheque ou paye par Paypal votre validation sera effective dans quelques jours. Un mail de confirmation vous sera envoye.')?>
		    </div>

                    <p>
                        <?php echo __('La validation de l inscription doit etre effectuee en un seul paiement de')?> <b><?php echo  $pricefinal ?>&euro;</b> (<?php echo $priceinitial?>&euro; - <?php echo $reduction?>&euro;) <?php echo __('pour la totalite de l equipe.')?>
                        <?php echo __('La validation sera effective au moment de la reception integrale du paiement.')?></p>
                        <br/>

                    <table width="100%">
						<?php if($countplayer == $countTournamentPlayer) : ?>
                        <tr><td colspan="2"><?php echo __('Vous avez le choix entre les deux moyens de paiement suivants')?> : <br/><br/></td></tr>
                        <tr>
                            <td>
                                <a class="button" href="<?php echo  url_for('tournament_slot/cheque'); ?>"><?php echo __('Paiement par cheque ici')?></a>
                            </td>
                            <td>
                                <a class="button" href="<?php echo  url_for('tournament_slot/paypal'); ?>"><?php echo __('Paiement par Paypal ici')?></a>

                            </td>
                        </tr>
                       	<?php else : ?>
                        	<tr><td colspan="2"><div class="flashbox error"><?php echo __('Votre equipe n est pas complete')?> (<?php echo $countplayer; ?>/<?php echo $countTournamentPlayer; ?>). <?php echo __('Vous devez completer votre equipe avant de pouvoir faire le paiement.')?></div></td></tr>
                        <?php endif; ?>
                    </table>


                    <?php endif; ?>
    <?php elseif ($tournamentslot->getStatus() == 'valide'): ?>
                        <h2><?php echo __('Votre equipe a bien valide toutes les etapes de l inscription au tournoi')?></h2>
    <?php endif; ?>


</div>
