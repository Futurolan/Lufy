<h2>R&eacute;sultats de la verification de la licence Masters.</h2>
<table class="table">
    <thead>
        <tr>
            <th>Nom du test</th>
            <th>Valeur test&eacute;e</th>
            <th>R&eacute;sultat du test</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Test du num&eacute;ro de licence</td>
            <td><?=$user->getLicenceMasters()?></td>
            <td><?= $test1 ?></td>
        </tr>
        <tr>
            <td>Test du Pr&eacute;nom</td>
            <td><?=$user->getFirstName()?></td>
            <td><?= $test2 ?></td>
        </tr>
        <tr>
            <td>Test du Nom</td>
            <td><?=$user->getLastName()?></td>
            <td><?= $test3 ?></td>
        </tr>
        <tr>
            <td>Test de la date de Naissance</td>
            <td><?=$user->getBirthdate()?></td>
            <td><?= $test4 ?></td>
        </tr>
    </tbody>
</table>

