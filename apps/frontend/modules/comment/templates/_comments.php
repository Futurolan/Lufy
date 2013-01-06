<h2>Commentaires</h2>
<? if ($auth == true):?>
<?php include_partial('comment/formComment', array('form' => $form)) ?>
<?endif;?>
<table>
    <tbody>
        <? foreach ($comments as $comment): ?>
            <tr style="border:solid 1px #ddd;background:red;">
                <? if ($comment->getSfGuardUser()->getLogourl() == NULL)
                        $image = '/uploads/profils/no-profil.png';
                   else
                       $image = $comment->getSfGuardUser()->getLogourl();
                   ;?>
                <td width="70" valign="top"><?= image_tag('' . $image, 'size=40x50') ?></td>
                <td valign="top">
                    <b>Post&eacute; le <?= $comment->getCreatedAt() ?> par <a href="<?= url_for('user/view?username=' . $comment->getSfGuardUser()->getUsername());?>"><?= $comment->getSfGuardUser() ?></a></b><br /><br/>
                <?= $comment->getContent() ?><br/><br/>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="2"></td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>
