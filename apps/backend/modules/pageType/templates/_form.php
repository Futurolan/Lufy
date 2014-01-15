<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('pageType/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_page_type=' . $form->getObject()->getIdPageType() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
        <table class="table">
            <tfoot>
                <tr>
                    <td colspan="2">
                    <?php echo $form->renderHiddenFields(false) ?>
                    &nbsp;<a href="<?php echo url_for('pageType/index') ?>" class="button">Retour &agrave; la liste</a>
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo ajax_link('Supprimer', 'pageType/delete?id_page_type=' . $form->getObject()->getIdPageType(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?', 'class' => 'button delete')) ?>
                    <?php endif; ?>
                        <input type="submit" value="Enregistrer" class="button save" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
            <?php echo $form->renderGlobalErrors() ?>
                <tr>
                    <th><?php echo $form['label']->renderLabel() ?></th>
                    <td>
                    <?php echo $form['label']->renderError() ?>
                    <?php echo $form['label'] ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo $form['description']->renderLabel() ?></th>
                    <td>
                    <?php echo $form['description']->renderError() ?>
                    <?php echo $form['description'] ?>
                    </td>
                </tr>
            </tr>
        </tbody>
    </table>
</form>
