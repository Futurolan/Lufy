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

<?php echo link_to(__('Inscription au tournoi'), 'tournament/registration?slug='.$tournament->getSlug(), array('class' => 'btn btn-primary')); ?>    
    <p>
      <?php //if ($tournament->getPlayerPerTeam() == 1): ?>
        <?php //echo __('Le tournoi se joue en <em>mode solo.</em>'); ?><br/>
      <?php //else: ?>
        <?php //echo __('Le tournoi se joue par <em>equipe de %nb_player% joueurs.</em>', array('%nb_player%' => $tournament->getPlayerPerTeam())); ?><br/>
      <?php //endif; ?>
      <?php //echo __('Les incriptions sont ouvertes pour <em>%nb_team% equipes.</em>', array('%nb_team%' => $tournament->getNumberTeam())); ?><br/>
      <?php //echo __('Le prix d\'entree est de <em>%price%&euro; par joueur.</em>', array('%price%' => $tournament->getCostPerPlayer())); ?>
    </p>

    <?php if ($admins->count() > 0): ?>
    <p>
      <?php echo __('Administrateur(s) du tournoi :'); ?>
      <?php foreach($admins as $admin):?>
        <a href="<?php echo  url_for('user/view?username=' . $admin->getSfGuardUser()->getUsername()) ?>"><?php echo $admin->getSfGuardUser()->getUsername();?></a>
      <?php endforeach;?>
    </p>
    <?php endif; ?>
  </div>
</div>


<?php if ($page): ?>
<h3><?php echo __('Informations')?></h3>
<?php echo $page->getContent(ESC_RAW)?>
<br/>
<?php endif; ?>

<h3><?php echo __('Liste des equipes inscrites')?></h3>
<?php // include_component('tournament_slot', 'teamAndPlayers', array('idtournament' => $tournament['id_tournament'], 'numberteam' => $tournament['number_team'])) ?>
