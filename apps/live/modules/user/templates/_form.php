<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

 <span style="font-size: 10px; color: red;"><?=__('Les champs marques * sont obligatoires pour valider votre inscription a un tournoi.')?></span>

<form action="<?php echo url_for('user/update?id='.$form->getObject()->getId()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="3">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a class="button" href="<?php echo url_for('user/index') ?>"><?=__('Revenir sur mon espace')?></a>
          <input class="button" type="submit" value="<?=__('Enregistrer')?>" />        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>

      <tr>
        <th><?=__('Prenom')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['first_name']->renderError() ?>
          <?php echo $form['first_name'] ?></td>
      </tr>
      <tr>
        <th><?=__('Nom')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['last_name']->renderError() ?>
          <?php echo $form['last_name'] ?>        </td>
      </tr>
      <tr>
        <th><?=__('Date de naissance')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['birthdate']->renderError() ?>
          <?php echo $form['birthdate'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Telephone')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['phone']->renderError() ?>
          <?php echo $form['phone'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Adresse')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['address']->renderError() ?>
          <?php echo $form['address'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Code Postal')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['zipcode']->renderError() ?>
          <?php echo $form['zipcode'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Ville')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['city']->renderError() ?>
          <?php echo $form['city'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Sexe')?></th>
        <td>
          <?php echo $form['gender']->renderError() ?>
          <?php echo $form['gender'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Pays')?> <span style="font-size: 10px; color: red;">*</span></th>
        <td>
          <?php echo $form['country']->renderError() ?>
          <?php echo $form['country'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Photo de profil (Url)')?></th>
        <td>
          <?php echo $form['logourl']->renderError() ?>
          <?php echo $form['logourl'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Site web (Url)')?></th>
        <td>
          <?php echo $form['website']->renderError() ?>
          <?php echo $form['website'] ?>        </td>
	  </tr>
	  <tr>
        <th><?=__('Carriere')?></th>
        <td>
          <?php echo $form['carrer']->renderError() ?>
          <?php echo $form['carrer'] ?>        </td>
	  </tr>
    </tbody>
  </table>
</form>
