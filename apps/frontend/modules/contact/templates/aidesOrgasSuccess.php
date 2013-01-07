<div class="box">
    <div class="title">Proposition d'aide pour la Gamers-Assembly 2013</div>
    <div class="content">
<p>
    La Gamers Assembly se d&eacute;roulera du 30 mars au 1er avril 2013 au Palais des Congr&egrave;s du Futuroscope.
    Les aides orgas seront accueillis d&egrave;s le jeudi matin 9h pour l'installation des salles.<br/><br/>
    Merci de bien d&eacute;tailler le/les poste(s) que vous souhaitez occuper et de remplir soigneusement le formulaire ci dessous :
</p>

<? if ($form->hasGlobalErrors()): ?>
    <div class="flashbox error"><?=$form->renderGlobalErrors()?></div>
<? endif; ?>

<form action='<?php echo url_for('contact/sendcontact')?>' method="post">
<?=$form->renderHiddenFields()?>
<fieldset>
    <legend>Informations personnelles</legend>
    <table class="form" width="100%" cellspacing="10">
        <tr>
            <th><?=$form['nom']->renderLabel()?></th>
            <td><?=$form['nom']->render()?></td>
            <th><?=$form['prenom']->renderLabel()?></th>
            <td><?=$form['prenom']->render()?></td>
        </tr>
        <tr>
            <th><?=$form['pseudo']->renderLabel()?></th>
            <td><?=$form['pseudo']->render()?></td>
            <th><?=$form['date_naissance']->renderLabel()?></th>
            <td><?=$form['date_naissance']->render()?></td>
        </tr>
        <tr>
            <th><?=$form['email']->renderLabel()?></th>
            <td><?=$form['email']->render()?></td>
            <th><?=$form['tel']->renderLabel()?></th>
            <td><?=$form['tel']->render()?></td>
        </tr>
        <tr>
            <th><?=$form['cp']->renderLabel()?></th>
            <td><?=$form['cp']->render()?></td>
            <th><?=$form['ville']->renderLabel()?></th>
            <td><?=$form['ville']->render()?></td>
        </tr>
    </table>
</fieldset>
<fieldset>
    <legend>Disponibilit&eacute;</legend>
    <table class="form" width="100%" cellspacing="10">
        <tr>
            <th><?=$form['date_arrivee']->renderLabel()?></th>
            <td colspan="2"><?=$form['date_arrivee']->render()?></td>
            <td></td>
        </tr>
        <tr>
            <th><?=$form['date_depart']->renderLabel()?></th>
            <td colspan="2"><?=$form['date_depart']->render()?></td>
            <td></td>
        </tr>
        <tr>
	    <th><?=$form['hebergement']->renderLabel()?></th>
            <td colspan="2"><?=$form['hebergement']->render()?></td>
            <td></td>
        </tr>

        <tr>
            <th><?=$form['postes']->renderLabel()?></th>
            <td colspan="3"><?=$form['postes']->render()?></td>
        </tr>
        <tr>
            <th><?=$form['commentaires']->renderLabel()?></th>
            <td colspan="3"><?=$form['commentaires']->render()?></td>
        </tr>
	<tr>
	    <td colspan="4">
		<p style="font-size: 10px;color:#666;">Les mineurs devront imp&eacute;rativement fournir une autorisation parentale &agrave; leur arriv&eacute;e sur le lieu de l'&eacute;v&egrave;nement.</p>
	    </td>
	</tr>
    </table>
    </fieldset>
	<input type="submit" value="Envoyer" class="button submit"><br/>
    </div>
</div>
