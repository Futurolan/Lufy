<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('faq/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_faq='.$form->getObject()->getIdFaq() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('faq/index') ?>" class="btn btn-default">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Supprimer', 'faq/delete?id_faq='.$form->getObject()->getIdFaq(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'btn btn-default')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="btn btn-default" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>Question</th>
        <td>
          <?php echo $form['request']->renderError() ?>
          <?php echo $form['request'] ?>
        </td>
      </tr>
      <tr>
        <th>R&eacute;ponse</th>
        <td>
          <?php echo $form['answer']->renderError() ?>
          <?php echo $form['answer'] ?>
        </td>
      </tr>
      <tr>
        <th>Statut</th>
        <td>
          <?php echo $form['status']->renderError() ?>
          <?php echo $form['status'] ?>
        </td>
      </tr>
      <tr>
        <th>Position</th>
        <td>
          <?php echo $form['position']->renderError() ?>
          <?php echo $form['position'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
