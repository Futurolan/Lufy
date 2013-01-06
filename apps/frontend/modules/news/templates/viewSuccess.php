<? use_helper('bb') ?>
<? use_helper('Date') ?>

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

<div class="box">
    <div class="title"><?=ucfirst($news->getTitle())?></div>
    <div class="content">
        <span style="font-size: 10px; color: grey;">Publi&eacute; le <?=format_date($news->getPublishOn(), 'dd/MM/yyy')?> par <?=link_to($news->getSfGuardUser(), 'user/view?username='.$news->getSfGuardUser())?></span>
        <?=bb_parse($news->getContent())?>

        <br/><br/>

        <div class="fb-like" data-href="<?=url_for('news/view?slug='.$news->getSlug(), true)?>" data-send="true" data-width="720" data-show-faces="true" data-font="tahoma"></div>
    </div>

    <br/><br/>

    <div class="title"><a name="commentaires"></a><?=__('Commentaires')?></div>
    <div class="content">
<table width="600px" margin="0" cellspacing="0" cellpadding="5">
    <tbody>
        <? foreach ($comments as $comment): ?>
            <tr style="background: #f0f0f0; border: solid 10px green;">
                <? if ($comment->getSfGuardUser()->getLogourl() == NULL)
                        $image = '/uploads/profils/no-profil.png';
                   else
                       $image = $comment->getSfGuardUser()->getLogourl();
                   ;?>
                <td width="60" align="center" valign="middle"><?= image_tag('' . $image, 'size=40x50') ?></td>
                <td valign="top">
		    <?=$comment->getContent() ?><br/>
                    <p style="font-size: 10px; color: #999;">Post&eacute; le <?=format_date($comment->getCreatedAt(), 'dd-MM-yyy') ?> par <a href="<?= url_for('user/view?username=' . $comment->getSfGuardUser()->getUsername());?>"><?= $comment->getSfGuardUser() ?></a></p>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="2"></td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

<? if ($sf_user->isAuthenticated()): ?>
<div class="subtitle">Ajouter un commentaire</div>
<form action="<?=url_for('comment/new')?>" method="POST" <?php $commentForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <input type="hidden" name="sf_method" value="put" />
    <input type="hidden" name="comment[news_id]" value="<?=$news->getIdNews()?>"/>
    <input type="hidden" name="comment[user_id]" value="<?=$user?>"/>
    <textarea name="comment[content]" rows="5" cols="80"></textarea>
    <br/>
    <input type="submit" class="button"/>
</form>
<? else: ?>
    <div class="flashbox info">Vous devez &ecirc;tre identifi&eacute; pour ajouter un commentaire.</div>
<? endif; ?>
</div>
</div>
