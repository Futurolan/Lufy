<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

 <span style="font-size: 10px; color: red;"><?php echo __('Les champs marques * sont obligatoires pour valider votre inscription a un tournoi.')?></span>

<form action="<?php echo url_for('user/update?id='.$form->getObject()->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="3">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a class="button" href="<?php echo url_for('user/index') ?>"><?php echo __('Revenir sur mon espace')?></a>
          <input class="button" type="submit" value="<?php echo __('Enregistrer')?>" />        </td>
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
