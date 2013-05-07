
<table class="listteam" cellspacing="0" cellpadding="5">
    <tr>
        <th>#</th>
        <th><?php echo __('Nom de l equipe')?></th>
        <th><?php echo __('Inscription')?></th>
    </tr>
    <?php $l = '1'; ?>
    <?php foreach ($slots as $slot): ?>
    <?if ($slot->getTeamId() == NULL || $slot->getStatus() == 'libre'): ?>
        <tr>
            <td><?php echo  $slot->getPosition() ?></td>
            <td><b>-</b></td>
            <td><?php echo  $slot->getStatus() ?></td>
        </tr>
    <?else: ?>
        <?php if($slot->getPosition() > $nb_team['number_team'] && $l == '1'): $l++;?>
        <th></th>
        <th><?php echo __('Debut de la liste d attente')?></th>
        <th></th>
        <?php endif; ?>
        <tr>
            <td><?php echo  $slot->getPosition() ?></td>
            <td><b><?php echo  link_to($slot->TeamName($slot->getTeamId()), 'team/view?slug=' . $slot->TeamSlug($slot->getTeamId())); ?></b></td>
            <td><?php echo  $slot->getStatus() ?> le <?php echo  $slot->getCreatedAt() ?></td>
        </tr>
    <?endif; ?>
    <?php endforeach; ?>
</table>

