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
        <th><?php echo __("Nom pour l'adresse")?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <th><?php echo __("Complememt d'Adresse")?></th>
        <td>
          <?php echo $form['complement']->renderError() ?>
          <?php echo $form['complement'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __("Adresse")?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['address']->renderError() ?>
          <?php echo $form['address'] ?>
        </td>
      </tr>
      <tr>
      <tr>
        <th><?php echo __('Code Postal')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['zipcode']->renderError() ?>
          <?php echo $form['zipcode'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __('Ville')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['city']->renderError() ?>
          <?php echo $form['city'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __('Pays')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['country']->renderError() ?>
          <?php echo $form['country'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
