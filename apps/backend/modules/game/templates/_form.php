<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('game/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_game='.$form->getObject()->getIdGame() : ''))?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false)?>
          &nbsp;<a href="<?php echo url_for('game/index')?>" class="button">Retour a la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'game/delete?id_game='.$form->getObject()->getIdGame(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors()?>
      <tr>
        <th>Nom</th>
        <td>
          <?php echo $form['label']->renderError()?>
          <?php echo $form['label']?>
        </td>
      </tr>
      <tr>
        <th>Genre</th>
        <td>
          <?php echo $form['game_type_id']->renderError()?>
          <?php echo $form['game_type_id']?>
        </td>
      </tr>
      <tr>
        <th>Plateforme</th>
        <td>
          <?php echo $form['plateform_id']->renderError()?>
          <?php echo $form['plateform_id']?>
        </td>
      </tr>
      <tr>
        <th>Editeur</th>
        <td>
          <?php echo $form['editor']->renderError()?>
          <?php echo $form['editor']?>
        </td>
      </tr>
      <tr>
        <th>Ann&eacute;e de sortie</th>
        <td>
          <?php echo $form['year']->renderError()?>
          <?php echo $form['year']?>
        </td>
      </tr>
      <tr>
        <th>Pr&eacute;sentation</th>
        <td>
          <?php echo $form['description']->renderError()?>
          <?php echo $form['description']?>
        </td>
      </tr>
      <tr>
        <th>Image</th>
        <td>
          <?php echo $form['logourl']->renderError()?>
          <?php echo $form['logourl']?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
