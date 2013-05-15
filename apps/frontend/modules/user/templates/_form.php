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

      <tr>
        <th><?php echo __('Prenom')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['first_name']->renderError() ?>
          <?php echo $form['first_name'] ?></td>
      </tr>
      <tr>
        <th><?php echo __('Nom')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['last_name']->renderError() ?>
          <?php echo $form['last_name'] ?>        </td>
      </tr>
    </tbody>
  </table>
</form>
