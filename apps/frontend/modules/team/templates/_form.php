<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('team/new');?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

  <input type="hidden" name="sf_method" value="post" />

  <?php echo $form->renderGlobalErrors() ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          <input class="btn btn-primary" type="submit" value="Enregister" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form['name']->renderRow() ?>
      <?php echo $form['tag']->renderRow() ?>
      <?php echo $form['country']->renderRow() ?>
      <?php echo $form['logourl']->renderRow() ?>
      <?php echo $form['website']->renderRow() ?>
      <?php echo $form['description']->renderRow() ?>
    </tbody>
  </table>
</form>