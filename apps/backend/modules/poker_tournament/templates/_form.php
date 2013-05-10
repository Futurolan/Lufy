<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('poker_tournament/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_poker_tournament='.$form->getObject()->getIdPokerTournament() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a class="button" href="<?php echo url_for('poker_tournament/index') ?>">Retour</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'poker_tournament/delete?id_poker_tournament='.$form->getObject()->getIdPokerTournament(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
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
        <th>Description</th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th>Icone</th>
        <td>
          <?php echo $form['image']->renderError() ?>
          <?php echo $form['image'] ?>
        </td>
      </tr>
      <tr>
        <th>Nombre de slots</th>
        <td>
          <?php echo $form['number_slot']->renderError() ?>
          <?php echo $form['number_slot'] ?>
        </td>
      </tr>
      <tr>
        <th>Dont reserv&eacute;s</th>
        <td>
          <?php echo $form['slot_reserved']->renderError() ?>
          <?php echo $form['slot_reserved'] ?>
        </td>
      </tr>
      <tr>
        <th>Début du tournois</th>
        <td>
          <?php echo $form['start_at']->renderError() ?>
          <?php echo $form['start_at'] ?>
        </td>
      </tr>
      <tr>
        <th>Fin du tournois</th>
        <td>
          <?php echo $form['end_at']->renderError() ?>
          <?php echo $form['end_at'] ?>
        </td>
      </tr>
      <tr>
        <th>Actif</th>
        <td>
          <?php echo $form['is_active']->renderError() ?>
          <?php echo $form['is_active'] ?>
        </td>
      </tr>
      <tr>
        <th>Slug</th>
        <td>
          <?php echo $form['slug']->renderError() ?>
          <?php echo $form['slug'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
