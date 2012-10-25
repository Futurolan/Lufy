<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('poker_tournament_player/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_poker_tournament_player='.$form->getObject()->getIdPokerTournamentPlayer() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('poker_tournament_player/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Delete', 'poker_tournament_player/delete?id_poker_tournament_player='.$form->getObject()->getIdPokerTournamentPlayer(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>ID utilisateur</th>
        <td>
          <?php echo $form['user_id']->renderError() ?>
          <?php echo $form['user_id'] ?>
        </td>
      </tr>
      <tr>
        <th>ID Tournois</th>
        <td>
          <?php echo $form['poker_tournement_id']->renderError() ?>
          <?php echo $form['poker_tournement_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Pseudo winamax</th>
        <td>
          <?php echo $form['pseudo']->renderError() ?>
          <?php echo $form['pseudo'] ?>
        </td>
      </tr>
      <tr>
        <th>Invit&eacute; ?</th>
        <td>
          <?php echo $form['is_invite']->renderError() ?>
          <?php echo $form['is_invite'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
