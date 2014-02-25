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
                    &nbsp;<a href="<?php echo url_for('tournament_slot/tournament?slug=' . $form->getObject()->getTournament()->getSlug()) ?>" class="btn btn-default">Retour a la liste</a>
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to('Supprimer le slot', 'tournament_slot/delete?id_tournament_slot=' . $form->getObject()->getIdTournamentSlot(), array('class' => 'btn btn-default')) ?>
                    <?php endif; ?>
                        <input type="submit" value="Save" class="btn btn-default"/>
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
                    <th><?php echo $form['is_valid']->renderLabel() ?></th>
                    <td>
                    <?php echo $form['is_valid']->renderError() ?>
                    <?php echo $form['is_valid'] ?>
                </td>
                <tr>
                    <th><?php echo $form['is_locked']->renderLabel() ?></th>
                    <td>
                    <?php echo $form['is_locked']->renderError() ?>
                    <?php echo $form['is_locked'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
