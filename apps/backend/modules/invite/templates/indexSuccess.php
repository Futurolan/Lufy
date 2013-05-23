<h2>Liste des invitations</h2>

<table class="table">
    <thead>
        <tr>
            <th>Id invite</th>
            <th>Team</th>
            <th>Destinataire</th>
            <th>Ami(e)</th>
            <th>Type</th>
            <th>Status</th>
            <th>D&eacute;but</th>
            <th>Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invites as $invite): ?>
            <tr>
                <td><a href="<?php echo url_for('invite/edit?id_invite=' . $invite->getIdInvite()) ?>"><?php echo $invite->getIdInvite() ?></a></td>
                <td><?= $invite->getTeam()->name ?></td>
                <td><?php echo $invite->getUser($invite->getUserId()) ?></td>
                <td><?php if ($invite->getFriendId()) echo $invite->getUser($invite->getFriendId()) ?></td>
                <td><?php echo $invite->getAction() ?></td>
                <td><?php echo $invite->getStatus() ?></td>
                <td><?php echo $invite->getCreatedAt() ?></td>
                <td><?php echo $invite->getUpdatedAt() ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?php echo url_for('invite/new') ?>">New</a>
