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
            <td><?php echo $user->getLicenceMasters()?></td>
            <td><?php echo  $test1 ?></td>
        </tr>
        <tr>
            <td>Test du Pr&eacute;nom</td>
            <td><?php echo $user->getFirstName()?></td>
            <td><?php echo  $test2 ?></td>
        </tr>
        <tr>
            <td>Test du Nom</td>
            <td><?php echo $user->getLastName()?></td>
            <td><?php echo  $test3 ?></td>
        </tr>
        <tr>
            <td>Test de la date de Naissance</td>
            <td><?php echo $user->getBirthdate()?></td>
            <td><?php echo  $test4 ?></td>
        </tr>
    </tbody>
</table>

