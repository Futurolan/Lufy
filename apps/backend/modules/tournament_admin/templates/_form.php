<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('tournament_admin/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?user_id='.$form->getObject()->getUserId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('tournament_admin/index')?>" class="button">Retour &agrave la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'tournament_admin/delete?user_id='.$form->getObject()->getUserId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button"/>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['user_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['user_id']->renderError() ?>
          <?php echo $form['user_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['tournament_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['tournament_id']->renderError() ?>
          <?php echo $form['tournament_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
