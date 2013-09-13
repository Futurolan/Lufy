<table class="table table-condensed table-striped">
  <thead>
    <tr>
        <th></th>
        <th>#</th>
        <th><?php echo __('Nom de lequipe')?></th>
        <th><?php echo __('Joueurs')?></th>
    </tr>
  </thead>
  <tbody>
    <?php $i = '0'; ?>
    <?php foreach ($slots as $slot): ?>
    <?php $i++ ?>
    <?php if ($i == $attente): ?>
        <tr>
            <th colspan="4"> <?php echo __('Debut de la liste dattente')?> </th>
        </tr>
    <?php endif ?>

        <tr>
            <td>
            <?
            if ($slot->getStatus() == 'valide' || $slot->getStatus() == 'reserve') { echo image_tag('16/slot_validate.png'); }
            elseif ($slot->getStatus() == 'attente' || $slot->getStatus() == 'inscrit') { echo image_tag('16/slot_waiting.png'); }
            ?>
            </td>
            <td><?php echo  $slot->getPosition() ?></td>
            <td><?php if (!$slot->getTeamId()): ?><?php echo  $slot->getStatus() ?></td>
                <td>
            <?php else: ?>
                <b><?php echo  link_to($slot->TeamName($slot->getTeamId()), 'team/view?slug=' . $slot->TeamSlug($slot->getTeamId())); ?></b>
                </td>
        <?php include_component('team', 'players', array('idteam' => $slot->getTeamId())) ?>
        <?php endif; ?>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br/>
&nbsp;&nbsp;&nbsp;
<?php echo image_tag('16/slot_validate.png')?> <?php echo __('Valide')?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo image_tag('16/slot_waiting.png')?> <?php echo __('En attente de paiement')?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
