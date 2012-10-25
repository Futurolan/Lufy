<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('news_type/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_news_type='.$form->getObject()->getIdNewsType() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('news_type/index') ?>" class="button">Retour a la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'news_type/delete?id_news_type='.$form->getObject()->getIdNewsType(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['label']->renderLabel() ?></th>
        <td>
          <?php echo $form['label']->renderError() ?>
          <?php echo $form['label'] ?>
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
        <th><?php echo $form['logourl']->renderLabel() ?></th>
        <td>
          <?php echo $form['logourl']->renderError() ?>
          <?php echo $form['logourl'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_special']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_special']->renderError() ?>
          <?php echo $form['is_special'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
