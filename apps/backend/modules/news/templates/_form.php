<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  var o = {
    buttonList: ['save','bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','indent','outdent','image','link','unlink','forecolor','bgcolor', 'xhtml'],
    iconsPath:('http://js.nicedit.com/nicEditIcons-latest.gif')
  };
  new nicEditor(o).panelInstance('news_summary');
});
</script>

<form action="<?php echo url_for('news/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_news='.$form->getObject()->getIdNews() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="4">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('news/index') ?>" class="button">Retour &agrave; la liste</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo ajax_link('Supprimer', 'news/delete?id_news='.$form->getObject()->getIdNews(), array('class' => 'button delete', 'method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" class="button save" /><br/>
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
        <th>Auteur</th>
        <td>
          <?php echo $form['user_id']->renderError() ?>
          <?php echo $form['user_id'] ?>
        </td>
      </tr>
      <tr>
        <th>Cat&eacute;gorie</th>
        <td>
          <?php echo $form['news_type_id']->renderError() ?>
          <?php echo $form['news_type_id'] ?>
        </td>
        <th>Image</th>
        <td>
          <?php echo $form['image']->renderError() ?>
          <?php echo $form['image'] ?><br/>
          <span style="font-size:10px; font-weight:normal; font-style: italic; color:#888;">Uniquement pour les articles de la cat&eacute;gorie "A l'affiche"</span>
        </td>
      </tr>
      <tr>
        <th>Publi&eacute; le</th>
        <td>
          <?php echo $form['publish_on']->renderError() ?>
          <?php echo $form['publish_on'] ?>
        </td>
        <th>Statut</th>
        <td>
          <?php echo $form['status']->renderError() ?>
          <?php echo $form['status'] ?>
        </td>
      </tr>
      <tr>
        <th>R&eacute;sum&eacute;</th>
        <td colspan="3">
          <?php echo $form['summary']->renderError() ?>
          <?php echo $form['summary'] ?>
        </td>
      </tr>
      <tr>
        <th>Contenu</th>
        <td colspan="3">
          <?php echo $form['content']->renderError() ?>
          <?php echo $form['content'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
