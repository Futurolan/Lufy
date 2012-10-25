<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('newsletter/send?id_newsletter=' . $form->getObject()->getIdNewsletter()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <input type="hidden" name="sf_method" value="put" />
    <table class="table">
        <tfoot>
            <tr>
                <td colspan="2">
                    <?php echo $form->renderHiddenFields(false) ?>
                    &nbsp;<a href="<?php echo url_for('newsletter/index') ?>" class="button">Annuler</a>
                    <input type="submit" value="Envoyer la newsletter" class="button" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>

                    <tr>
                        <th>Destinataires</th>
                        <td>
                    <?php echo $form['recipient']->renderError() ?>
                    <?php echo $form['recipient'] ?>
                </td>
            </tr>

        </tbody>
    </table>
</form>
