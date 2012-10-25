<table class="listteam" cellspacing="0" cellpadding="5">
    <tr>
        <th>#</th>
        <th><?=__('Nom de lequipe')?></th>
        <th><?=__('Joueurs')?></th>
    </tr>
    <? $i = '0'; ?>
    <?php foreach ($slots as $slot): ?>
    <? $i++ ?>
    <? if ($i == $attente): ?>
        <? break; ?>
    <? endif; ?>

        <tr>
            <td><?= $slot->getPosition() ?></td>
            <td><? if (!$slot->getTeamId()): ?><?= $slot->getStatus() ?></td>
                <td>
            <? else: ?>
                <b><?=$slot->TeamName($slot->getTeamId()); ?></b>
                </td>
        <? include_component('team', 'players', array('idteam' => $slot->getTeamId())) ?>
        <? endif; ?>
        </tr>
    <? endforeach; ?>
</table>
