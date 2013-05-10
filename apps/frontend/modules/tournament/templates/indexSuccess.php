<div class="box">
	<div class="title"><?php echo __('Tournois')?></div>
        <div class="content">
        <?php echo __('Choississez le tournoi auquel vous souhaitez participer')?> :<br/><br/>
	<?php foreach ($lastevents as $lastevent): ?>
          <?php foreach ($tournaments as $tournament): ?>
            <?php if ($tournament->getEvent()->getIdEvent() == $lastevent->getIdEvent()): ?>
                <?php echo image_tag('/uploads/jeux/icones/'.$tournament->getLogourl())?> <?php echo link_to($tournament->getName(), 'tournament/redirect?id_tournament='.$tournament->getidTournament());?> <i>(<?php echo $tournament->getGame()->getGameType()?>)</i><br/><br/>
            <?php endif; ?>
         <?php endforeach; ?>
       <?php endforeach; ?>
    </div>
</div>
