<div class="box">
    <h3><?=__('Paiement par Paypal')?></h3>
    <p><?=__('En cliquant sur le bouton Acheter vous allez etre redirige vers le site de paiement en ligne Paypal. Vous serez alors invite a entrer vos informations de carte bancaire ou a vous connecter avec votre compte Paypal pour effectuer le paiement.')?>
    <br/>
    <?=__('La validation de l inscription est effective dans les 24 a 48h suivant le paiement.')?>
    </p>
    <br/>
    <p><b><?=__('Recapituatif de votre paiement')?> :</b><br/>
        <?=__('Prix total')?>: <?=$pricettc?> &euro;<br/>
        <?=__('Inscription')?> <?=$tournament->getName()?><br/>
        <br/>    </p>

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <input type="hidden" name="amount" value="<?=$pricettc?>"/>
          <input name="currency_code" type="hidden" value="EUR" />
          <input name="shipping" type="hidden" value="0.00" />
          <input name="tax" type="hidden" value="0.00" />
          <input name="return" type="hidden" value="http://www.gamers-assembly.net/tournament_slot" />
          <input name="cancel_return" type="hidden" value="http://www.gamers-assembly.net/tournament_slot" />
          <input name="notify_url" type="hidden" value="http://www.gamers-assembly.net/ppresult.php" />
          <input name="cmd" type="hidden" value="_xclick" />
          <input name="business" type="hidden" value="paypal@futurolan.net" />
          <input name="item_name" type="hidden" value="Inscription GA" />
          <input name="no_note" type="hidden" value="1" />
          <input name="lc" type="hidden" value="FR" />
          <input name="bn" type="hidden" value="PP-BuyNowBF" />
          <input name="custom" type="hidden" value="<?=$userinfo->getLicenceGa()?>" />
          <input alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et securisee" name="submit" src="https://www.paypal.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" type="image" /><img src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" border="0" alt="" width="1" height="1" />
        </form>
</div>
