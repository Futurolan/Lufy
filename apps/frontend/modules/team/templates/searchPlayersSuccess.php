<?php include_partial('searchPlayers', array('team' => $team)) ?>
<?php echo link_to('<i></i> '.__('Retour'), 'team/view?slug='.$team->getSlug(), array('class' => 'btn')); ?>