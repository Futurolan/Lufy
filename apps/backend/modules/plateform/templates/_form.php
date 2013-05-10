<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('plateform/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_plateform='.$form->getObject()->getIdPlateform() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('plateform/index') ?>" class="button">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Delete', 'plateform/delete?id_plateform='.$form->getObject()->getIdPlateform(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" class="button" />
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
        <th><?php echo $form['tag']->renderLabel() ?></th>
        <td>
          <?php echo $form['tag']->renderError() ?>
          <?php echo $form['tag'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['constructor']->renderLabel() ?></th>
        <td>
          <?php echo $form['constructor']->renderError() ?>
          <?php echo $form['constructor'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
