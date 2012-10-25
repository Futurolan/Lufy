<? use_helper('bb') ?>

<div class="box">
    <div class="title"><?=__('Reglement')?></div>
    <div class="content">
    <?=bb_parse($reglement->getValue())?><br/><br/>
    <?=link_to(__('J accepte le reglement et je confirme ma participation'), 'tournament_slot/insertTeam?slug=' . $tournament->getSlug(), array('class' => 'button')); ?> 
    <?=link_to(__('Je refuse et j annule mon inscription'), '@homepage', array('class' => 'button')); ?>
    </div>
</div>
