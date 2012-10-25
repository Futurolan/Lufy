<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('file/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_file='.$form->getObject()->getIdFile() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('file/index') ?>">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Delete', 'file/delete?id_file='.$form->getObject()->getIdFile(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>Nom</th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th>Clef</th>
        <td>
          <?php echo $form['file']->renderError() ?>
          <?php echo $form['file'] ?>
          <br/>
          <span style="font-size:10px; font-weight:normal; font-style: italic; color:#888;">Exemple : http://www.dailymotion.com/video/<b style="color: #333;">k172VBFPNL3B6T2hAeh</b></span>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th>Type</th>
        <td>
          <?php echo $form['file_type_id']->renderError() ?>
          <?php echo $form['file_type_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Categorie</th>
        <td>
          <?php echo $form['file_category_id']->renderError() ?>
          <?php echo $form['file_category_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Statut</th>
        <td>
          <?php echo $form['status']->renderError() ?>
          <?php echo $form['status'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
