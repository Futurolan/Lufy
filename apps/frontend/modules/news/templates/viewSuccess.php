<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<h2><?php echo ucfirst($news->getTitle())?></h2>

<?php echo bb_parse($news->getContent())?>

<br/>

<small class="pull-right">
    <?php echo __('Redige par %1% le %2%', array('%1%' => $news->getSfGuardUser(), '%2%' => format_date($news->getPublishOn(), 'dd MMMM yyyy'))); ?>
</small>


<br/><br/>
<br/><br/>


<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=183148825128872";
  fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-like" data-href="<?=url_for('news/view?slug='.$news->getSlug(), true)?>" data-send="true" data-width="825" data-show-faces="true" data-font="tahoma"></div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=183148825128872";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<?=url_for('news/view?slug='.$news->getSlug(), true)?>" data-width="825" data-numposts="10" data-colorscheme="light"></div>

