<?php use_javascript('ajax/search.js') ?>

<div class="box">
  <div class="title">Recherche</div>
  <div class="content">
    <form class="search" action="<?php echo url_for('search/search')?>" method="get" style="display: inline; margin-right: 20px;">
      <input type="text" name="query" size="25" value="<?php echo $sf_request->getParameter('query')?>" id="search_keywords" style="width: 130px; background: #fff url('http://syphobbl.free.fr/zbuntu/images/icone_recherche_avancee.png') no-repeat 95% 50%;" />
      <input type="submit" value="<?php echo __('Go')?>" />
      <img id="loader" src="/images/loading.gif" style="vertical-align: middle; display: none" />
    </form>
  </div>

  <div id="result"></div>

  <?php
/*  include_partial('search/resultSearch', array(
      'news' => $news,
  ));
*/  ?>
</div>
