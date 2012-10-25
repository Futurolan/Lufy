<div class="box">
    <div class="title">Formulaire de contact</div>
    <div class="content">
<p>
    Vous souhaitez sponsoriser un tournoi, exposer lors de notre manifestation ou simplement associer votre image &agrave; la notre&nbsp;?
    Nous poss&eacute;dons de nombreuses solutions de communication et d'entraide afin de cr&eacute;er des collaborations "gagnant-gagnant". 
    Contactez nous en d&eacute;crivant votre activit&eacute; et votre projet, nous nous engageons &agrave; revenir vers vous rapidement pour d&eacute;finir la mani&egrave;re dont nous pouvons travailler &agrave; vos c&ocirc;t&eacute;s ! 
</p>

<form action='<?php echo url_for('contact/sendcontactpartner')?>' method="post">
<table class='contact'>
<?php echo $form?>
    <tr>
	<th>&nbsp;</th>
	<td><input type='submit' value='Envoyer'></td>
    </tr>
</table>
</form>
    </div>
</div>
