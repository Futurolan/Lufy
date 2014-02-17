<h2><?= __('Inscription') ?> <?php echo $tournament->getName() ?></h2>

<div class="row-fluid">
  <div class="span12">
    <div>
      <?php $team = $sf_user->getGuardUser()->TeamPlayer[0]->getTeam() ?>
      <? if (!$register): ?>
        <div class="alert alert-info">
          Vous devez <?=link_to(__('confirmer votre inscription'), 'tournament/registrationConfirm?slug=' . $tournament->getSlug() . '&team_slug=' . $team->getSlug())?> au tournoi.
        </div>
      <? endif;
      ?>
      <h3><?=__('Equipe')?> <?php echo $team->getName(); ?></h3>

      <table class="table" width="100%">
        <? $nbPlayer = 0; ?>
        <? foreach ($sf_user->getGuardUser()->TeamPlayer[0]->getTeam()->getTeamPlayer() as $player): ?>
          <? if ($player->getIsPlayer()): ?>
            <? $status = true; ?>
            <tr>
              <td><?php echo $player->getSfGuardUser()->getUsername(); ?></td>
              <td><?php echo $player->getSfGuardUser()->getFirstName(); ?> <?php echo substr($player->getSfGuardUser()->getLastName(), 0, 1); ?>.</td>
              <td width="450px">
                    <div class="progress" style="width: 450px;">

                <? if (!$teamPlayer[$player->getUserId()]['profile']): ?>
                  <div class="bar bar-danger" style="width: 150px;">
                    <i class="icon-remove"></i> 
                  <? $status = false; ?>
                <? else: ?>
                  <div class="bar bar-success" style="width: 150px;">
                    <i class="icon-ok"></i> 
                <? endif; ?>
                    <?=__('Etat du profil')?>
                  </div>
                  
                <? if (!$teamPlayer[$player->getUserId()]['address']): ?>
                  <div class="bar bar-danger" style="width: 150px;">
                    <i class="icon-remove"></i> 
                  <? $status = false; ?>
                <? else: ?>
                  <div class="bar bar-success" style="width: 150px;">
                    <i class="icon-ok"></i> 
                <? endif; ?>
                    <?=__('Adresse par defaut')?>
                  </div>
                  
                <? if (!$teamPlayer[$player->getUserId()]['weezevent']): ?>
                  <div class="bar bar-danger" style="width: 150px;">
                    <i class="icon-remove"></i> 
                  <? $status = false; ?>
                <? else: ?>
                  <div class="bar bar-success" style="width: 150px;">
                    <i class="icon-ok"></i> 
                <? endif; ?>
                    <?=__('Billet Weezevent')?>
                  </div>
                  
                <? if ($status): ?>
                  <span class="label label-success">OK !</span>
                <? endif; ?>
              </td>
            </tr>
          <? endif; ?>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
 
 
<style>
.progress {
  font-size: 10px;
  font-weight: bold;
}
.progress .bar {
  text-align: left;
  padding-left: 10px;
}
</style>