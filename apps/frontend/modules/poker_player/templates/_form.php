<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('poker_player/addPlayer?slug='.$tournament->getSlug())?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>Pseudo Winamax</th>
        <td>
          <?php echo $form['pseudo']->renderError() ?>
          <?php echo $form['pseudo'] ?>
        </td>
      </tr>
  </table>
  <br/>
  <div style="width: 600px; margin: auto auto;"><a href="http://www.arjel.fr/" target="_blank"><?php echo image_tag('mention-poker.png')?></a></div>
  <br/>
  <?php echo $form->renderHiddenFields() ?>
  <?php echo link_to('ANNULER', 'poker_tournament/index', array('class' => 'button'))?>&nbsp;
  <input type="submit" value="Valider" />
</form>
