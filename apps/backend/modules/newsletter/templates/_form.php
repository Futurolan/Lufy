<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('newsletter/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_newsletter='.$form->getObject()->getIdNewsletter() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('newsletter/index') ?>" class="button">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Delete', 'newsletter/delete?id_newsletter='.$form->getObject()->getIdNewsletter(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" class="button"/>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['subject']->renderLabel() ?></th>
        <td>
          <?php echo $form['subject']->renderError() ?>
          <?php echo $form['subject'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['content']->renderLabel() ?></th>
        <td>
          <?php echo $form['content']->renderError() ?>
          <?php echo $form['content'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
