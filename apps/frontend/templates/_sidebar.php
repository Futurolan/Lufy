<h3><?php echo __('Nos partenaires'); ?></h3>
<?php include_component('partner', 'rolling')?>


<h3><?php echo __('Tournois')?></h3>
<em>&Agrave; venir...</em>
<?php /* include_component('tournament', 'nexttournament'); */?>
<!--
<?php //include_component('poker_tournament', 'list');?>
-->


<h3><?php echo __('Suivez la GA sur')?></h3>
<a href="http://www.facebook.com/GamersAssembly" target="_blank"><?php echo image_tag('../css/frontend/galloween2013/facebook.png')?></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://twitter.com/GamersAssembly" target="_blank"><?php echo image_tag('../css/frontend/galloween2013/twitter.png')?></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo url_for('feed/rss2'); ?>" target="_blank"><?php echo image_tag('../css/frontend/galloween2013/rss.png')?></a>
