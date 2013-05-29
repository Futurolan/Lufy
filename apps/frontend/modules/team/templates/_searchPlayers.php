<h2><?php echo __('Rechercher des joueurs pour mon équipe')?></h2>
<form action="<?php //echo url_for('team/searchPlayers?slug='.$request->getParameter('slug')) ?>" method="get">
  <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
  <input type="submit" value="search" />
</form>