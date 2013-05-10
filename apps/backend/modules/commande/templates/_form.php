<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('commande/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_commande='.$form->getObject()->getIdCommande() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('commande/index') ?>" class="button">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Delete', 'commande/delete?id_commande='.$form->getObject()->getIdCommande(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" class="button" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['tournament_slot_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['tournament_slot_id']->renderError() ?>
          <?php echo $form['tournament_slot_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['item_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['item_name']->renderError() ?>
          <?php echo $form['item_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['amount']->renderLabel() ?></th>
        <td>
          <?php echo $form['amount']->renderError() ?>
          <?php echo $form['amount'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['reduction']->renderLabel() ?></th>
        <td>
          <?php echo $form['reduction']->renderError() ?>
          <?php echo $form['reduction'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
