<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('page/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_page='.$form->getObject()->getIdPage() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('page/index') ?>" class="button">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'page/delete?id_page='.$form->getObject()->getIdPage(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class' => 'button delete')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>Titre</th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th>Slug</th>
        <td>
          <?php echo $form['slug']->renderError() ?>
          <?php echo $form['slug'] ?><br/>
          <i style="font-size: 10px; color: grey;">La modification du slug changera l'url de la page. http://www.gamers-assembly.net/page/slug</i>
        </td>
      </tr>
      <tr>
        <th>Cat&eacute;gorie</th>
        <td>
          <?php echo $form['page_type_id']->renderError() ?>
          <?php echo $form['page_type_id'] ?>
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
        <th>Publi&eacute; le</th>
        <td>
          <?php echo $form['publish_on']->renderError() ?>
          <?php echo $form['publish_on'] ?>
        </td>
      </tr>
      <tr>
        <th valign="top">Contenu</th>
        <td>
          <?php echo $form['content']->renderError() ?>
          <?php echo $form['content'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
