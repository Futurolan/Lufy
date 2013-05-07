<?php use_helper('bb') ?>
<?php use_helper('Date') ?>

<div class="box">
    <div class="title"><?php echo ucfirst($news->getTitle())?></div>
    <div class="content">
                <span style="font-size: 10px; color: grey;">Publi&eacute; le <?php echo format_date($news->getPublishOn(), 'dd/MM/yyy')?> par <?php echo link_to($news->getSfGuardUser(), 'user/view?username='.$news->getSfGuardUser())?></span>
    <?php echo bb_parse($news->getContent())?>
<!--
    <br/><br/>
    <script src="http://connect.facebook.net/fr_FR/all.js#xfbml=1"></script><fb:like layout="button_count" show_faces="false" width="80" height="20" font="verdana"></fb:like>
    <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="GamersAssembly" data-lang="fr">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
-->
    <br/><br/>
    <?php echo image_tag('/css/gamersassembly/img/postnews.gif')?>
    <a href="http://www.facebook.com/GamersAssembly" target="_blank"><?php echo image_tag('/css/gamersassembly/img/facebook.gif')?></a>
    <a href="https://twitter.com/GamersAssembly" target="_blank"><?php echo image_tag('/css/gamersassembly/img/twitter.gif')?></a>
    <a href="http://www.dailymotion.com/gamersassembly" target="_blank"><img src="/css/gamersassembly/img/dailymotion.gif" /></a>
    </div>
<br/><br/>

    <div class="title">Commentaires</div>
    <div class="content">
<table width="600px" margin="0" cellspacing="0" cellpadding="5">
    <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr style="background: #f0f0f0; border: solid 10px green;">
                <?php if ($comment->getSfGuardUser()->getLogourl() == NULL)
                        $image = '/uploads/profils/no-profil.png';
                   else
                       $image = $comment->getSfGuardUser()->getLogourl();
                   ;?>
                <td width="60" align="center" valign="middle"><?php echo  image_tag('' . $image, 'size=40x50') ?></td>
                <td valign="top">
		    <?php echo $comment->getContent() ?><br/>
                    <i style="font-size: 10px; color: #999;">Post&eacute; le <?php echo format_date($comment->getCreatedAt(), 'dd-MM-yyy') ?> par <a href="<?php echo  url_for('user/view?username=' . $comment->getSfGuardUser()->getUsername());?>"><?php echo  $comment->getSfGuardUser() ?></a></p>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="2"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($sf_user->isAuthenticated()): ?>
<h5>Ajouter un commentaire</h5>
<form action="<?php echo url_for('comment/new')?>" method="POST" <?php $commentForm->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <input type="hidden" name="sf_method" value="put" />
    <input type="hidden" name="comment[news_id]" value="<?php echo $news->getIdNews()?>"/>
    <input type="hidden" name="comment[user_id]" value="<?php echo $user?>"/>
    <textarea name="comment[content]" rows="5" cols="80"></textarea>
    <br/>
    <input type="submit" value="Envoyer" class="button"/>
</form>
<?php else: ?>
    <div class="flashbox info">Vous devez &ecirc;tre identifi&eacute; pour ajouter un commentaire.</div>
<?php endif; ?>
</div>
</div>
