<?php foreach ($tournaments as $tournament): ?>
  <div class="tournament" style="background-image: url('/uploads/jeux/icones/<?php echo $tournament->getLogourl(); ?>');"><?php echo link_to($tournament->getName(), 'tournament/view?slug='.$tournament->getSlug()); ?></a></div>
  <?php
  // Recuperer le taux de remplissage du tournoi
  ?>
<?php endforeach; ?>


<style>
.tournament {
  background-repeat: no-repeat;
  background-position: center left;
  padding-left: 20px;
  margin: 5px 0px 5px 0px;
  font-size: 13px;
}
</style>
