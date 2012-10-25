
<table class="listteam" cellspacing="0" cellpadding="5">
    <tr>
        <th>#</th>
        <th><?=__('Nom de l equipe')?></th>
        <th><?=__('Inscription')?></th>
    </tr>
    <? $l = '1'; ?>
    <?php foreach ($slots as $slot): ?>
    <?if ($slot->getTeamId() == NULL || $slot->getStatus() == 'libre'): ?>
        <tr>
            <td><?= $slot->getPosition() ?></td>
            <td><b>-</b></td>
            <td><?= $slot->getStatus() ?></td>
        </tr>
    <?else: ?>
        <? if($slot->getPosition() > $nb_team['number_team'] && $l == '1'): $l++;?>
        <th></th>
        <th><?=__('Debut de la liste d attente')?></th>
        <th></th>
        <? endif; ?>
        <tr>
            <td><?= $slot->getPosition() ?></td>
            <td><b><?= link_to($slot->TeamName($slot->getTeamId()), 'team/view?slug=' . $slot->TeamSlug($slot->getTeamId())); ?></b></td>
            <td><?= $slot->getStatus() ?> le <?= $slot->getCreatedAt() ?></td>
        </tr>
    <?endif; ?>
    <? endforeach; ?>
</table>

