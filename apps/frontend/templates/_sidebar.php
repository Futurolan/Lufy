<h3><?php echo __('Nos partenaires'); ?></h3>
<?php include_component('partner', 'rolling')?>


<h3><?php echo __('Tournois')?></h3>
<em>&Agrave; venir...</em>
<br/>
<?php echo link_to('Voir les &eacute;quipes inscrites', 'tournament/list?slug=none', array('class' => 'btn btn-small'))?>
<br/>
<br/>
<?php /* include_component('tournament', 'nexttournament'); */?>
<!--
<?php //include_component('poker_tournament', 'list');?>
-->


<h3><?php echo __('Suivez la GA sur')?></h3>
<a href="http://www.facebook.com/GamersAssembly" target="_blank"><?php echo image_tag('../css/gamersassembly/img/icone-facebook.jpg')?></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://twitter.com/GamersAssembly" target="_blank"><?php echo image_tag('../css/gamersassembly/img/icone-twitter.jpg')?></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="http://www.dailymotion.com/GamersAssembly" target="_blank"><?php echo image_tag('../css/gamersassembly/img/icone-dailymotion.jpg')?></a>
