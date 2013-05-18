<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<h2><?php echo ucfirst($news->getTitle())?></h2>

<?php echo bb_parse($news->getContent())?>

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


<h3><a name="commentaires"></a><?php echo __('Commentaires')?></h3>

<?php foreach ($comments as $comment): ?>
  <?php
  if (!$comment->getSfGuardUser()->getSfGuardUserProfile()->getLogourl()):
    $image = '/uploads/profils/no-profil.png';
  else:
    $image = $comment->getSfGuardUser()->getSfGuardUserProfile()->getLogourl();
  endif;
  ?>
  <div class="row-fluid">
    <div class="span2"><?php echo image_tag($image) ?></div>
    <div class="span10">
      <?php echo $comment->getContent() ?>
      <br/><br/>
      <span style="font-size: 11px; color: #888;">Post&eacute; le <?php echo format_date($comment->getCreatedAt(), 'dd-MM-yyy') ?> par <a href="<?php echo  url_for('user/view?username='. $comment->getSfGuardUser()->getUsername());?>"><?php echo $comment->getSfGuardUser() ?></a></span>
    </div>
  </div>
  <br/><br/>
<?php endforeach; ?>

<?php if ($sf_user->isAuthenticated()): ?>
<div class="subtitle">Ajouter un commentaire</div>
  <form action="<?php echo url_for('comment/new')?>" method="POST" <?php $commentForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <input type="hidden" name="sf_method" value="put" />
    <input type="hidden" name="comment[news_id]" value="<?php echo $news->getIdNews()?>"/>
    <input type="hidden" name="comment[user_id]" value="<?php echo $user?>"/>
    <textarea name="comment[content]" rows="3"class="span8"></textarea>
    <br/>
    <input type="submit" class="btn btn-primary"/>
  </form>
<?php else: ?>
  <div class="alert alert-info">Vous devez &ecirc;tre identifi&eacute; pour ajouter un commentaire.</div>
<?php endif; ?>
