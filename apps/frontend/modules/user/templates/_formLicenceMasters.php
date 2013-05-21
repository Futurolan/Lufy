<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('user/licenceMasters');?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

<input type="hidden" name="sf_method" value="post" />

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>

          <input type="submit" value="Enregister" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo __('Numero de licence Masters')?></th>
        <td>
          <?php echo $form->renderGlobalErrors() ?>

          <?php echo $form['serial']->renderRow(); ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
