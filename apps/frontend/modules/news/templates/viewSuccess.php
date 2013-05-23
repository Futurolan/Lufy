<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<h2><?php echo ucfirst($news->getTitle())?></h2>

<?php echo bb_parse($news->getContent())?>

<br/>

<small class="pull-right">
    <?php echo __('Redige par %1% le %2%', array('%1%' => $news->getSfGuardUser(), '%2%' => format_date($news->getPublishOn(), 'dd MMMM yyyy'))); ?>
</small>

<br/>

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

<div class="fb-like" data-href="<?php echo url_for('news/view?slug='.$news->getSlug(), true)?>" data-send="true" data-width="720" data-show-faces="true" data-font="tahoma"></div>

<hr />

<h3><a name="commentaires"></a><?php echo __('Commentaires')?></h3>

<?php foreach ($comments as $comment): ?>
  <div class="well well-small">
    <?php echo $comment->getContent() ?>
    <br />
    <small>
      <?php echo __('Poste par %1% le %2% a %3%', array(
        '%1%' => link_to($comment->getSfGuardUser(), 'user/view?username='.$comment->getSfGuardUser()),
        '%2%' => format_date($comment->getCreatedAt(), 'dd MMMM yyyy'),
        '%3%' => format_date($comment->getCreatedAt(), 'HH:mm')
      )); ?>
    </small>
  </div>
<?php endforeach; ?>

<br />

<?php if ($sf_user->isAuthenticated()): ?>
<h4><?php echo __('Ajouter un commentaire'); ?></h4>
  <form action="<?php echo url_for('comment/new')?>" method="POST" <?php $commentForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <input type="hidden" name="sf_method" value="put" />
    <input type="hidden" name="comment[news_id]" value="<?php echo $news->getIdNews()?>"/>
    <input type="hidden" name="comment[user_id]" value="<?php echo $user?>"/>
    <textarea name="comment[content]" rows="3"class="span8"></textarea>
    <br/>
    <input type="submit" class="btn btn-primary"/>
  </form>
<?php else: ?>
  <div class="alert alert-info"><?php echo __('Vous devez etre identifie pour ajouter un commentaire.'); ?></div>
<?php endif; ?>
