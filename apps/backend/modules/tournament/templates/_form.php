<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('tournament/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_tournament='.$form->getObject()->getIdTournament() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('tournament/index') ?>" class="button">Retour à la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'tournament/delete?id_tournament='.$form->getObject()->getIdTournament(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button" /><br/>
          <i>La suppression d'un tournois entrainera également la suppression des slots, commandes, paiements et admins qui sont liés à ce tournois.</i>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>Jeu</th>
        <td>
          <?php echo $form['game_id']->renderError() ?>
          <?php echo $form['game_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Evenement</th>
        <td>
          <?php echo $form['event_id']->renderError() ?>
          <?php echo $form['event_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Libellé du tournoi</th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th>Statut</th>
        <td>
          <?php echo $form['is_active']->renderError() ?>
          <?php echo $form['is_active'] ?>
        </td>
      </tr>
      <tr>
        <th>Nombre d'équipes</th>
        <td>
          <?php echo $form['number_team']->renderError() ?>
          <?php echo $form['number_team'] ?>
        </td>
      </tr>
      <tr>
        <th>Joueurs par équipe</th>
        <td>
          <?php echo $form['player_per_team']->renderError() ?>
          <?php echo $form['player_per_team'] ?>
        </td>
      </tr>
      <tr>
        <th>Prix par joueur</th>
        <td>
          <?php echo $form['cost_per_player']->renderError() ?>
          <?php echo $form['cost_per_player'] ?>
        </td>
      </tr>
      <tr>
        <th>Nombre de slots reservés</th>
        <td>
          <?php echo $form['reserved_slot']->renderError() ?>
          <?php echo $form['reserved_slot'] ?>
        </td>
      </tr>
      <tr>
        <th>Début du tournoi</th>
        <td>
          <?php echo $form['start_at']->renderError() ?>
          <?php echo $form['start_at'] ?>
        </td>
      </tr>
      <tr>
        <th>Fin du tournoi</th>
        <td>
          <?php echo $form['end_at']->renderError() ?>
          <?php echo $form['end_at'] ?>
        </td>
      </tr>
      <tr>
        <th>Icone</th>
        <td>
          <?php echo $form['logourl']->renderError() ?>
          <?php echo $form['logourl'] ?>
        </td>
      </tr>
      <tr>
        <th>URL du règlement</th>
        <td>
          <?php echo $form['rules_url']->renderError() ?>
          <?php echo $form['rules_url'] ?>
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
        <th><?php echo $form['slug']->renderLabel() ?></th>
        <td>
          <?php echo $form['slug']->renderError() ?>
          <?php echo $form['slug'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
