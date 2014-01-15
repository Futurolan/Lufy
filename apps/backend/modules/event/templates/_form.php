<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('event/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_event='.$form->getObject()->getIdEvent() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('event/index') ?>" class="button">Retour a la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'event/delete?id_event='.$form->getObject()->getIdEvent(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
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
        <th><?php echo $form['start_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['start_at']->renderError() ?>
          <?php echo $form['start_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['end_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['end_at']->renderError() ?>
          <?php echo $form['end_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['start_registration_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['start_registration_at']->renderError() ?>
          <?php echo $form['start_registration_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['end_registration_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['end_registration_at']->renderError() ?>
          <?php echo $form['end_registration_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['image']->renderLabel() ?></th>
        <td>
          <?php echo $form['image']->renderError() ?>
          <?php echo $form['image'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['address']->renderLabel() ?></th>
        <td>
          <?php echo $form['address']->renderError() ?>
          <?php echo $form['address'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['map_url']->renderLabel() ?></th>
        <td>
          <?php echo $form['map_url']->renderError() ?>
          <?php echo $form['map_url'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
