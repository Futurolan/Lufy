<h2><?=__('Inscription au tournoi')?> <?php echo $tournament->getName()?></h2>

<div class="row-fluid">
  <div class="span12">
    <div>
      <?=__('Avant de confirmer votre inscription au tournoi merci de verifier les informations ci-dessous et vous devez accepter de reglement interieur de la manifestation.')?>
    </div>
    <br/>
    <div>...RECAP TEAM, TOURNOI, MONTANT TOTAL, PROCEDURE D'INSCRIPTION...</div>
    <br/>
    <div>...LE REGLEMENT ICI DANS UNE DIV SCROLLABLE...</div>
    <br/>
    <div>
      <?=link_to(__('J accepte le reglement'), 'tournament/registrationConfirm?slug='.$tournament->getSlug().'&team_slug=', array('class' => 'btn btn-success'))?>
      <?=link_to(__('Je refuse le reglement'), 'tournament/view?slug='.$tournament->getSlug(), array('class' => 'btn btn-danger'))?>
    </div>
  </div>
</div>