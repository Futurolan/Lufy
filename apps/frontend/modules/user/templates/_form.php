<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

 <span style="font-size: 10px; color: red;"><?php echo __('Les champs marques * sont obligatoires pour valider votre inscription a un tournoi.')?></span>

<form action="<?php echo url_for('user/editProfile') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="3">
          <a class="button" href="<?php echo url_for('user/index') ?>"><?php echo __('Revenir sur mon espace')?></a>
          <input class="button" type="submit" value="<?php echo __('Enregistrer')?>" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>

      <?php echo $form['first_name']->renderRow(); ?>
      <?php echo $form['last_name']->renderRow(); ?>
      <?php echo $form['birthdate']->renderRow(); ?>
      <?php echo $form['gender']->renderRow(); ?>
      <?php echo $form['phone']->renderRow(); ?>
      <?php echo $form['website']->renderRow(); ?>
      <?php echo $form['carrer']->renderRow(); ?>

      <?php echo $form->renderHiddenFields() ?>
    </tbody>
  </table>
</form>
