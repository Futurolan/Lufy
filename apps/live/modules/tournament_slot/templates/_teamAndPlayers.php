<table class="listteam" cellspacing="0" cellpadding="5">
    <tr>
        <th>#</th>
        <th><?php echo __('Nom de lequipe')?></th>
        <th><?php echo __('Joueurs')?></th>
    </tr>
    <?php $i = '0'; ?>
    <?php foreach ($slots as $slot): ?>
    <?php $i++ ?>
    <?php if ($i == $attente): ?>
        <?php break; ?>
    <?php endif; ?>

        <tr>
            <td><?php echo  $slot->getPosition() ?></td>
            <td><?php if (!$slot->getTeamId()): ?><?php echo  $slot->getStatus() ?></td>
                <td>
            <?php else: ?>
                <b><?php echo $slot->TeamName($slot->getTeamId()); ?></b>
                </td>
        <?php include_component('team', 'players', array('idteam' => $slot->getTeamId())) ?>
        <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>
