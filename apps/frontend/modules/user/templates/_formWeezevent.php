<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('user/weezevent');?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

  <input type="hidden" name="sf_method" value="post" />

  <?php echo $form->renderGlobalErrors() ?>

  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          <input class="btn btn-primary" type="submit" value= <?php echo __('Enregistrer');?> />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <th><?=__('Code barre')?></th>
        <td><?php echo $form['barcode'] ?></td>
      </tr>
    </tbody>
  </table>
</form>
