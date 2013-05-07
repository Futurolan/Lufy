<h2>Commentaires</h2>
<?php if ($auth == true):?>
<?php include_partial('comment/formComment', array('form' => $form)) ?>
<?endif;?>
<table>
    <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr style="border:solid 1px #ddd;background:red;">
                <?php if ($comment->getSfGuardUser()->getLogourl() == NULL)
                        $image = '/uploads/profils/no-profil.png';
                   else
                       $image = $comment->getSfGuardUser()->getLogourl();
                   ;?>
                <td width="70" valign="top"><?php echo  image_tag('' . $image, 'size=40x50') ?></td>
                <td valign="top">
                    <b>Post&eacute; le <?php echo  $comment->getCreatedAt() ?> par <a href="<?php echo  url_for('user/view?username=' . $comment->getSfGuardUser()->getUsername());?>"><?php echo  $comment->getSfGuardUser() ?></a></b><br /><br/>
                <?php echo  $comment->getContent() ?><br/><br/>
                </td>
            </tr>
            <tr>
                <td height="20" colspan="2"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
