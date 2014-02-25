<h2>R&eacute;sultats des checks</h2>
<ol>
    <li>V&eacute;rifie que le nombre de slot n'est pas inf&eacute;rieur &agrave; la valeur du nombre de team du tournoi.</li>
    <li>V&eacute;rifie que les position des slots sont cons&eacute;cutives sur un tournoi.</li>
    <li>V&eacute;rifie que les premiers slots sont bien en status 'reserve' ou 'valide'.</li>
</ol>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Nom</th>
            <th>R&eacute;sultats</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tournaments as $tournament): ?>
            <tr>
                <td><?= image_tag('/uploads/jeux/icones/' . $tournament->getLogourl()) ?></td>
                <td><a href="<?= url_for('tournament/edit?id_tournament=' . $tournament->getIdTournament()) ?>"><?= $tournament->getName() ?></a></td>
                <td><?php include_component('tournament', 'check', array('idtournament' => $tournament->getIdTournament())) ?></td>
                <td><a href="<?= url_for('tournament/edit?id_tournament=' . $tournament->getIdTournament()) ?>">Modifier</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br />
<a href="<?php echo url_for('tournament/index') ?>" class="btn btn-default">Retourner &agrave; la liste des tournoi</a>
<a href="<?= url_for('tournament/check') ?>" class="btn btn-default">Verifier l'int&eacute;grit&eacute; des slots</a>
