<h2><?php echo $tournament->getName()?></h2>

<div class="row-fluid">
  <div class="span5">
    <?php echo  image_tag('/uploads/jeux/images/' . $tournament->getGame()->getLogourl(), array('class' => 'img-polaroid')) ?>
  </div>
  <div class="span7">
    <p><?php echo  $tournament->getGame()->getDescription() ?></p>

    <p>
      <strong><?php echo __('Jeu')?> :</strong> <?php echo  $tournament->getGame() ?><br/>
      <strong><?php echo __('Editeur')?> :</strong> <?php echo  $tournament->getGame()->getEditor() ?><br/>
      <strong><?php echo __('Genre')?> :</strong> <?php echo  $tournament->getGame()->getGameType() ?><br/>
      <strong><?php echo __('Plateforme')?> :</strong> <?php echo  $tournament->getGame()->getPlateform() ?>
    </p>

    <p>
      <? if ($tournament->getPlayerPerTeam() == 1): ?>
        <?=__('Le tournoi est ouvert pour %nb_team% joueurs.', array('%nb_team%' => $tournament->getNumberTeam())); ?><br/>
      <? else: ?>
        <?=__('Le tournoi est ouvert pour %nb_team% equipes de %nb_player% joueurs.', array('%nb_team%' => $tournament->getNumberTeam(), '%nb_player%' => $tournament->getPlayerPerTeam())); ?><br/>
      <? endif; ?>
      <?=__('Le prix d\'entree est de %price%&euro; par joueur.', array('%price%' => $tournament->getCostPerPlayer())); ?>
    </p>

    <? if ($tournament->registrationIsActive()): ?>
    <p style="text-align: right;">
      <?=link_to(__('Inscription au tournoi'), 'tournament/registration?slug='.$tournament->getSlug(), array('class' => 'btn btn-primary')); ?>
    </p>
    <? endif; ?>
    
    <? if ($admins->count() > 0): ?>
    <p>
      <?=__('Administrateur(s) du tournoi :'); ?>
      <? foreach($admins as $admin): ?>
        <a href="<?=url_for('user/view?username=' . $admin->getSfGuardUser()->getUsername()) ?>">
          <?=$admin->getSfGuardUser()->getUsername();?>
        </a>
      <? endforeach; ?>
    </p>
    <? endif; ?>
  </div>
</div>


<? if ($page): ?>
  <h3><?=__('Informations')?></h3>
  <?=$page->getContent(ESC_RAW)?>
  <br/>
<? endif; ?>

<h3><?=__('Liste des equipes inscrites')?></h3>
<?php // include_component('tournament_slot', 'teamAndPlayers', array('idtournament' => $tournament['id_tournament'], 'numberteam' => $tournament['number_team'])) ?>
