<script src="http://www.gamers-assembly.net/js/jquery-1.4.2.min.js"></script>
<script src="http://www.gamers-assembly.net/js/jquery.barcode.js"></script>
<script>
	$(window).load(function() {
        $(".barcode").barcode("<?=$user->getLicenceGa()?>", "ean13");
    }
    );
</script>
<style>
table tr th { text-align: left; }
body, tr, td {
    font-family: "Lucida Sans", Tahoma, Verdana;
    font-size: 12px;
}
.flashbox {
    border: solid 2px black;
    padding: 10px;
    margin-bottom: 20px;
    width: 600px;
    font-size: 11px;
    font-family: "Lucida Sans", Tahoma, Verdana;
}

.info {
    border-color: #4a79b2;
    background-color: #e0ebf2;
    color: #2c436b;
}

.barcode {
    width: 150px;
    text-align: center;
    margin-left: 150px;
}
</style>
<a href="javascript:window.print()">Imprimer</a><br/><br/>
<div>
    <img src="http://www.gamers-assembly.net/uploads/assets/ga2012-nb.jpg"/>
</div>
<br/>
<div class="flashbox info">
    Bulletin de participation &agrave; imprimer et &agrave; pr&eacute;senter &agrave; l'accueil lors de votre arriv&eacute;e avec une pi&egrave;ce d'identit&eacute;.
</div>
<br/>
<table width="600px">
    <tr>
        <th>Nom</th>
        <td><?=$user->getLastName()?></td>
        <th>Prenom</th>
        <td><?=$user->getFirstName()?></td>
    </tr>
    <tr>
        <th>Pseudo</th>
        <td><?=$user->getUsername()?></td>
        <th>Date de naissance</th>
        <td><?=$user->getBirthdate()?></td>
    </tr>
    <tr>
        <th>Equipe</th>
        <td>
            <? foreach ($user->getTeam() as $team): ?>
                <?=$team->getName()?>
            <? endforeach; ?>
        </td>
        <th>Tournoi</th>
        <td>
            <? foreach ($tournaments as $tournament): ?>
                <?=$tournament->getTournament()->getName()?>
            <? endforeach; ?>
        </td>
    </tr>
    <tr>
        <th>Code equipe</th>
        <td>
            <? foreach ($user->getTeam() as $team): ?>
                <?=$team->getSlug()?>
            <? endforeach; ?>
        </td>
        <th>Code joueur</th>
        <td><?=$user->getLicenceGa()?></td>
    </tr>
</table>
<br><br>
<div class="barcode" onload="javascript:$('.barcode').barcode('<?=$user->getLicenceGa()?>', 'ean13');">barcode</div>
