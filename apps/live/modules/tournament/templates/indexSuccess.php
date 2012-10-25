<div class="box">
	<div class="title"><?=__('Tournois')?></div>
        <div class="content">
        <?=__('Choississez le tournoi auquel vous souhaitez participer')?> :<br/><br/>
	<? foreach ($lastevents as $lastevent): ?>
          <? foreach ($tournaments as $tournament): ?>
            <? if ($tournament->getEvent()->getIdEvent() == $lastevent->getIdEvent()): ?>
                <?=image_tag('/uploads/jeux/icones/'.$tournament->getLogourl())?> <?=link_to($tournament->getName(), 'tournament/redirect?id_tournament='.$tournament->getidTournament());?> <i>(<?=$tournament->getGame()->getGameType()?>)</i><br/><br/>
            <? endif; ?>
         <? endforeach; ?>
       <? endforeach; ?>
    </div>
</div>
