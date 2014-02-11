<h2><?= __('Inscription au tournoi') ?> <?php echo $tournament->getName() ?></h2>

<div class="row-fluid">
  <div class="span12">
    <div>
      <?= __('Avant de confirmer votre inscription au tournoi merci de verifier les informations ci-dessous et vous devez accepter de reglement interieur de la manifestation.') ?>
    </div>
    <br/>
    <div>
    <?php $team = $sf_user->getGuardUser()->TeamPlayer[0]->getTeam() ?>
    <h3><?php echo $team->getName(); ?></h3>
    <table class="table">
      <tr>
        <td align="center" valign="top" rowspan="5" width="200">
          <img src="<?php echo $team->getLogourl(); ?>" width="200" />
        </td>
        <td><?php echo __('Team') ?></td>
        <td><?php echo $team->getName() ?></td>
      </tr>
      <tr>
        <td><?php echo __('Tag') ?></td>
        <td><?php echo $team->getTag() ?></td>
      </tr>
      <tr>
        <td><?php echo __('Cree le') ?></td>
        <td><?php echo $team->getCreatedAt() ?></td>
      </tr>
    </table>
    <h3><?php echo __('Composition'); ?></h3>
    <table class="table">
      <? $nbPlayer = 0 ; ?>
      <? foreach ($sf_user->getGuardUser()->TeamPlayer[0]->getTeam()->getTeamPlayer() as $player): ?>
        <? if ($player->getIsPlayer()): ?>
        <tr>
          <td><?php echo $player->getSfGuardUser()->getUsername(); ?></td>
          <td><?php echo $player->getSfGuardUser()->getFirstName(); ?> <?php echo substr($player->getSfGuardUser()->getLastName(), 0, 1); ?>.</td>
          <td>
            <span class="label"><?php if ($player->getIsCaptain() == 1) echo __('Manager'); ?></span>
            <span class="label"><?php if ($player->getIsPlayer() == 1) echo __('Joueur'); ?></span>
          </td>
          <td><?php echo $tournament->getCostPerPlayer() ?> &euro;</td>
        </tr>
        <? endif; ?>
        <?php $nbPlayer += 1; ?>
      <?php endforeach; ?>
    </table>
    <h4><?php echo __('Total :').' '.$nbPlayer*$tournament->getCostPerPlayer().' &euro;';?></h4>
    <br/>
    PROCEDURE D'INSCRIPTION...
  </div>
  
  <div>...LE REGLEMENT ICI DANS UNE DIV SCROLLABLE...</div>
  <br/>
  <div>
    <?= link_to(__('J accepte le reglement'), 'tournament/registrationConfirm?slug=' . $tournament->getSlug() . '&team_slug='.$team->getSlug(), array('class' => 'btn btn-success')) ?>
    <?= link_to(__('Je refuse le reglement'), 'tournament/view?slug=' . $tournament->getSlug(), array('class' => 'btn btn-danger')) ?>
  </div>
</div>
</div>
