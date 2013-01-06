<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('user/register');?>" method="POST" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

<input type="hidden" name="sf_method" value="put" />

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
        <th><?=__('Prenom')?></th>
        <td>
          <?php echo $form['first_name']->renderError() ?>
          <?php echo $form['first_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?=__('Nom')?></th>
        <td>
          <?php echo $form['last_name']->renderError() ?>
          <?php echo $form['last_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?=__('Adresse mail')?></i></th>
        <td>
          <?php echo $form['email_address']->renderError() ?>
          <?php echo $form['email_address'] ?>
        </td>
      </tr>
      <tr>
        <th><?=__('Pseudo')?></th>
        <td>
          <?php echo $form['username']->renderError() ?>
          <?php echo $form['username'] ?>
        </td>
      </tr>
      <tr>
        <th><?=__('Password')?></th>
        <td>
          <?php echo $form['password']->renderError() ?>
          <?php echo $form['password'] ?>
        </td>
      </tr>

    </tbody>
  </table>
</form>
