<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('team/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_team='.$form->getObject()->getIdTeam() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('team/index') ?>" class="button"><?php echo __('Annuler')?></a>
          <input type="submit" value="<?php echo __('Enregistrer les modification')?>" class="button" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
     
      <tr>
        <th><?php echo __('Nom')?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __('Tag')?></th>
        <td>
          <?php echo $form['tag']->renderError() ?>
          <?php echo $form['tag'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __('Pays')?></th>
        <td>
          <?php echo $form['country']->renderError() ?>
          <?php echo $form['country'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __('Logo (url)')?></th>
        <td>
          <?php echo $form['logourl']->renderError() ?>
          <?php echo $form['logourl'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __('Site web')?></th>
        <td>
          <?php echo $form['website']->renderError() ?>
          <?php echo $form['website'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo __('Presentation')?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
