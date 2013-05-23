<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('gallery/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_gallery='.$form->getObject()->getIdGallery() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a class="button" href="<?php echo url_for('gallery/index') ?>">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'gallery/delete?id_gallery='.$form->getObject()->getIdGallery(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input class="button" type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
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
        <th><?php echo $form['status']->renderLabel() ?></th>
        <td>
          <?php echo $form['status']->renderError() ?>
          <?php echo $form['status'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['position']->renderLabel() ?></th>
        <td>
          <?php echo $form['position']->renderError() ?>
          <?php echo $form['position'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['album_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['album_id']->renderError() ?>
          <?php echo $form['album_id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
