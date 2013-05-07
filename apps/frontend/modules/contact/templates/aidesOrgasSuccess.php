<div class="box">
    <div class="title">Proposition d'aide pour la Gamers-Assembly 2013</div>
    <div class="content">
<p>
    La Gamers Assembly se d&eacute;roulera du 30 mars au 1er avril 2013 au Palais des Congr&egrave;s du Futuroscope.
    Les aides orgas seront accueillis d&egrave;s le jeudi matin 9h pour l'installation des salles.<br/><br/>
    Merci de bien d&eacute;tailler le/les poste(s) que vous souhaitez occuper et de remplir soigneusement le formulaire ci dessous :
</p>

<?php if ($form->hasGlobalErrors()): ?>
    <div class="flashbox error"><?php echo $form->renderGlobalErrors()?></div>
<?php endif; ?>

<form action='<?php echo url_for('contact/sendcontact')?>' method="post">
<?php echo $form->renderHiddenFields()?>
<fieldset>
    <legend>Informations personnelles</legend>
    <table class="form" width="100%" cellspacing="10">
        <tr>
            <th><?php echo $form['nom']->renderLabel()?></th>
            <td><?php echo $form['nom']->render()?></td>
            <th><?php echo $form['prenom']->renderLabel()?></th>
            <td><?php echo $form['prenom']->render()?></td>
        </tr>
        <tr>
            <th><?php echo $form['pseudo']->renderLabel()?></th>
            <td><?php echo $form['pseudo']->render()?></td>
            <th><?php echo $form['date_naissance']->renderLabel()?></th>
            <td><?php echo $form['date_naissance']->render()?></td>
        </tr>
        <tr>
            <th><?php echo $form['email']->renderLabel()?></th>
            <td><?php echo $form['email']->render()?></td>
            <th><?php echo $form['tel']->renderLabel()?></th>
            <td><?php echo $form['tel']->render()?></td>
        </tr>
        <tr>
            <th><?php echo $form['cp']->renderLabel()?></th>
            <td><?php echo $form['cp']->render()?></td>
            <th><?php echo $form['ville']->renderLabel()?></th>
            <td><?php echo $form['ville']->render()?></td>
        </tr>
    </table>
</fieldset>
<fieldset>
    <legend>Disponibilit&eacute;</legend>
    <table class="form" width="100%" cellspacing="10">
        <tr>
            <th><?php echo $form['date_arrivee']->renderLabel()?></th>
            <td colspan="2"><?php echo $form['date_arrivee']->render()?></td>
            <td></td>
        </tr>
        <tr>
            <th><?php echo $form['date_depart']->renderLabel()?></th>
            <td colspan="2"><?php echo $form['date_depart']->render()?></td>
            <td></td>
        </tr>
        <tr>
	    <th><?php echo $form['hebergement']->renderLabel()?></th>
            <td colspan="2"><?php echo $form['hebergement']->render()?></td>
            <td></td>
        </tr>

        <tr>
            <th><?php echo $form['postes']->renderLabel()?></th>
            <td colspan="3"><?php echo $form['postes']->render()?></td>
        </tr>
        <tr>
            <th><?php echo $form['commentaires']->renderLabel()?></th>
            <td colspan="3"><?php echo $form['commentaires']->render()?></td>
        </tr>
	<tr>
	    <td colspan="4">
		<i style="font-size: 10px;color:#666;">Les mineurs devront imp&eacute;rativement fournir une autorisation parentale &agrave; leur arriv&eacute;e sur le lieu de l'&eacute;v&egrave;nement.</p>
	    </td>
	</tr>
    </table>
    </fieldset>
	<input type="submit" value="Envoyer" class="button submit"><br/>
    </div>
</div>
