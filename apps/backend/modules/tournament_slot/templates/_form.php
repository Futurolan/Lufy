<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('tournament_slot/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_tournament_slot=' . $form->getObject()->getIdTournamentSlot() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
        <table class="table">
            <tfoot>
                <tr>
                    <td colspan="2">
                    <?php echo $form->renderHiddenFields(false) ?>
                    &nbsp;<a href="<?php echo url_for('tournament_slot/index') ?>" class="button">Back to list</a>
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo ajax_link('Liberer le slot', 'tournament_slot/setLibre?id_tournament_slot=' . $form->getObject()->getIdTournamentSlot(), array('class' => 'button')) ?>
                    <?php endif; ?>
                        <input type="submit" value="Save" class="button"/>
                    </td>
                </tr>
            </tfoot>
            <tbody>
            <?php echo $form->renderGlobalErrors() ?>
                        <tr>
                            <th><?php echo $form['team_id']->renderLabel() ?></th>
                            <td>
                    <?php echo $form['team_id']->renderError() ?>
                    <?php echo $form['team_id'] ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo $form['status']->renderLabel() ?></th>
                    <td>
                    <?php echo $form['status']->renderError() ?>
                    <?php echo $form['status'] ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo $form['locked']->renderLabel() ?></th>
                    <td>
                    <?php echo $form['locked']->renderError() ?>
                    <?php echo $form['locked'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
