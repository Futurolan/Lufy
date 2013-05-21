<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="alert alert-info"><?php echo __('Les champs marques * sont obligatoires pour valider votre inscription a un tournoi.')?></div>

<form action="<?php echo url_for('user/'.($form->getObject()->isNew() ? 'newAddress' : 'editAddress').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : ''))?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="3">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a class="btn" href="<?php echo url_for('user/address') ?>"><?php echo __('Retour')?></a>
          <input class="btn btn-primary" type="submit" value="<?php echo __('Enregistrer')?>" />        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>

      <?php echo $form['name']->renderRow(); ?>
      <?php echo $form['complement']->renderRow(); ?>
      <?php echo $form['address']->renderRow(); ?>
      <?php echo $form['zipcode']->renderRow(); ?>
      <?php echo $form['city']->renderRow(); ?>
      <?php echo $form['country']->renderRow(); ?>

      <?php echo $form->renderHiddenFields() ?>
    </tbody>
  </table>
</form>
