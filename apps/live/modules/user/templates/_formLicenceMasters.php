<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('licence/masters');?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

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
        <th><?=__('Numero de licence Masters')?></th>
        <td>
          <?php echo $form['licence_masters']->renderError() ?>
          <?php echo $form['licence_masters'] ?>
        </td>
      </tr>

    </tbody>
  </table>
</form>
