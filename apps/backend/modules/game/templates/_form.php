<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?=url_for('game/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_game='.$form->getObject()->getIdGame() : ''))?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?=$form->renderHiddenFields(false)?>
          &nbsp;<a href="<?=url_for('game/index')?>" class="btn btn-default">Retour a la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?=link_to('Supprimer', 'game/delete?id_game='.$form->getObject()->getIdGame(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?', 'class' => 'btn btn-default')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="btn btn-default" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?=$form->renderGlobalErrors()?>
      <tr>
        <th>Nom</th>
        <td>
          <?=$form['label']->renderError()?>
          <?=$form['label']?>
        </td>
      </tr>
      <tr>
        <th>Genre</th>
        <td>
          <?=$form['game_type_id']->renderError()?>
          <?=$form['game_type_id']?>
        </td>
      </tr>
      <tr>
        <th>Plateforme</th>
        <td>
          <?=$form['plateform_id']->renderError()?>
          <?=$form['plateform_id']?>
        </td>
      </tr>
      <tr>
        <th>Editeur</th>
        <td>
          <?=$form['editor']->renderError()?>
          <?=$form['editor']?>
        </td>
      </tr>
      <tr>
        <th>Ann&eacute;e de sortie</th>
        <td>
          <?=$form['year']->renderError()?>
          <?=$form['year']?>
        </td>
      </tr>
      <tr>
        <th>Pr&eacute;sentation</th>
        <td>
          <?=$form['description']->renderError()?>
          <?=$form['description']?>
        </td>
      </tr>
      <tr>
        <th>Image</th>
        <td>
          <?=$form['logourl']->renderError()?>
          <?=$form['logourl']?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
