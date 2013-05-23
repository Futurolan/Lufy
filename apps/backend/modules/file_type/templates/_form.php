<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('file_type/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_file_type='.$form->getObject()->getIdFileType() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a class="button" href="<?php echo url_for('file_type/index') ?>">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'file_type/delete?id_file_type='.$form->getObject()->getIdFileType(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input class="button" type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
