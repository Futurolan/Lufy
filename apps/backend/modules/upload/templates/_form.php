

<form action="<?php echo url_for('upload/create') ?>" method="post" enctype="multipart/form-data">
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('upload/index') ?>" class="btn btn-default">Retour a la liste</a>
           <input type="submit" value="Enregistrer" class="btn btn-default" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <th>Fichier</th>
        <td>
          <?php //echo $form['file']->renderError() ?>
          <?php echo $form['file'] ?>
        </td>
      </tr>
      <tr>
        <th>Repertoire</th>
        <td>
          <?php echo $form['path']->renderError() ?>
          <?php echo $form['path'] ?>
        </td>
      </tr>
      <tr>
        <th>Nom du fichier</th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
