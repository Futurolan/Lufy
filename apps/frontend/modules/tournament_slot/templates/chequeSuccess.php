<div class="box">
    <h3 class="H3Enhance"><?=__('Paiement par Cheque')?></h3>
    <div class="flashbox info"><p>
        <?=__('En cliquant sur le bouton Je confirme mon paiement je m engage a adresser un Cheque du montant indique dans les plus brefs delai.')?>
        <br/>
        <?=__('La validation de votre inscriptions sera effective a la reception du paiement pour la totalitee de l equipe.')?>
    </p></div>
    <br/>
    <div class="flashbox error"><p><?=__('Veuillez imprimer cette page est nous la renvoyer, avec votre Cheque, a l adresse suivante')?> :</p>
    <br/>
    <p>
        <?=__('Cheque a l ordre de : Association Futurolan')?><br/>
        <?=__('Association Futurolan')?><br/>
        <?=__('11 rue Paul Gauvin')?><br/>
        <?=__('86280 SAINT BENOIT')?>
    </p>
    </div>
    <div class="flashbox triadix">
        <?=__('Vous devez ajouter le nom de votre equipe ainsi que votre identifiant')?> (<?=$userinfo->getLicenceGa()?>) <?=__('au dos du cheque')?>.
    </div>
    <br/>
   
    <p>
    	<?=__('Equipe')?> : <?=$team->getName();  ?>
        <br/>
        <?=__('Identifiant')?> : <?=$userinfo->getLicenceGa()?>
        <br/>
        <?=__('Pseudo')?> : <?=$sf_user->getUsername(); ?>
        <br/>
        <?=__('Nom')?> : <?=$sf_user->getName(); ?>
        <br/>
        <?=__('Tournoi')?> : <?=$tournament->getName(); ?>
        <br/>
    </p>
    <br/>
    <p>
        <b><?=__('Recapituatif de votre paiement')?> :</b><br/>
        <?=__('Prix total')?> : <?=$price; ?> &euro;<br/>
        <br/>
    </p>
        <a class="button" href="<?=url_for('tournament_slot/paymentCheque'); ?>"><?=__('Je confirme mon paiement')?></a>
    </p>
</div>