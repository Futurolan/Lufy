<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<h2><?php echo __('Recruter pour mon équipe')?></h2>
<?php include_partial('searchPlayers') ?>
<?php include_partial('listPlayers') ?>