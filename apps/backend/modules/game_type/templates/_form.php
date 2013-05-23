<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('game_type/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_game_type='.$form->getObject()->getIdGameType() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <br />
		  <a href="<?php echo url_for('game_type/index') ?>" class="button">Retour a la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
          <?php echo ajax_link('Supprimer', 'game_type/delete?id_game_type='.$form->getObject()->getIdGameType(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button" />
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
    </tbody>
  </table>
</form>
