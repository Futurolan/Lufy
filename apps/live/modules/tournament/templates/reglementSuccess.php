<?php use_helper('bb') ?>

<div class="box">
    <div class="title"><?php echo __('Reglement')?></div>
    <div class="content">
    <?php echo bb_parse($reglement->getValue())?><br/><br/>
    <?php echo link_to(__('J accepte le reglement et je confirme ma participation'), 'tournament_slot/insertTeam?slug=' . $tournament->getSlug(), array('class' => 'button')); ?> 
    <?php echo link_to(__('Je refuse et j annule mon inscription'), '@homepage', array('class' => 'button')); ?>
    </div>
</div>
