<div class="box">
    <h3 class="H3Enhance"><?php echo __('Paiement par Cheque')?></h3>
    <div class="flashbox info"><p>
        <?php echo __('En cliquant sur le bouton Je confirme mon paiement je m engage a adresser un Cheque du montant indique dans les plus brefs delai.')?>
        <br/>
        <?php echo __('La validation de votre inscriptions sera effective a la reception du paiement pour la totalitee de l equipe.')?>
    </p></div>
    <br/>
    <div class="flashbox error"><p><?php echo __('Veuillez imprimer cette page est nous la renvoyer, avec votre Cheque, a l adresse suivante')?> :</p>
    <br/>
    <p>
        <?php echo __('Cheque a l ordre de : Association Futurolan')?><br/>
        <?php echo __('Association Futurolan')?><br/>
        <?php echo __('11 rue Paul Gauvin')?><br/>
        <?php echo __('86280 SAINT BENOIT')?>
    </p>
    </div>
    <div class="flashbox triadix">
        <?php echo __('Vous devez ajouter le nom de votre equipe ainsi que votre identifiant')?> (<?php echo $userinfo->getLicenceGa()?>) <?php echo __('au dos du cheque')?>.
    </div>
    <br/>
   
    <p>
    	<?php echo __('Equipe')?> : <?php echo $team->getName();  ?>
        <br/>
        <?php echo __('Identifiant')?> : <?php echo $userinfo->getLicenceGa()?>
        <br/>
        <?php echo __('Pseudo')?> : <?php echo $sf_user->getUsername(); ?>
        <br/>
        <?php echo __('Nom')?> : <?php echo $sf_user->getName(); ?>
        <br/>
        <?php echo __('Tournoi')?> : <?php echo $tournament->getName(); ?>
        <br/>
    </p>
    <br/>
    <p>
        <b><?php echo __('Recapituatif de votre paiement')?> :</b><br/>
        <?php echo __('Prix total')?> : <?php echo $price; ?> &euro;<br/>
        <br/>
    </p>
        <a class="button" href="<?php echo url_for('tournament_slot/paymentCheque'); ?>"><?php echo __('Je confirme mon paiement')?></a>
    </p>
</div>