<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('payement/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_payement='.$form->getObject()->getIdPayement() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a class="button" href="<?php echo url_for('payement/index') ?>">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'payement/delete?id_payement='.$form->getObject()->getIdPayement(), array('class' => 'button', 'method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>ID Commande</th>
        <td>
          <?php echo $form['commande_id']->renderError() ?>
          <?php echo $form['commande_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Payeur</th>
        <td>
          <?php echo $form['user_cashman_id']->renderError() ?>
          <?php echo $form['user_cashman_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Num transaction/cheque</th>
        <td>
          <?php echo $form['txn_id']->renderError() ?>
          <?php echo $form['txn_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Montant</th>
        <td>
          <?php echo $form['amount']->renderError() ?>
          <?php echo $form['amount'] ?>
        </td>
      </tr>
      <tr>
        <th>Valid&eacute;</th>
        <td>
          <?php echo $form['is_valid']->renderError() ?>
          <?php echo $form['is_valid'] ?>
        </td>
      </tr>
      <tr>
        <th>Paypal</th>
        <td>
          <?php echo $form['is_paypal']->renderError() ?>
          <?php echo $form['is_paypal'] ?>
        </td>
      </tr>
      <tr>
        <th>Date cr&eacute;ation / &Eacute;dition</th>
        <td><?=$form->getObject()->getCreatedAt()?>&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;<?=$form->getObject()->getUpdatedAt()?></td>
      </tr>
    </tbody>
  </table>
</form>
