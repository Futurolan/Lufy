<table class="listteam" cellspacing="0" cellpadding="5">
    <tr>
        <th></th>
        <th>#</th>
        <th><?=__('Nom de lequipe')?></th>
        <th><?=__('Joueurs')?></th>
    </tr>
    <? $i = '0'; ?>
    <?php foreach ($slots as $slot): ?>
    <? $i++ ?>
    <? if ($i == $attente): ?>
        <tr>
            <th colspan="4"> <?=__('Debut de la liste dattente')?> </th>
        </tr>
    <? endif ?>

        <tr>
            <td>
            <?
            if ($slot->getStatus() == 'valide' || $slot->getStatus() == 'reserve') { echo image_tag('16/slot_validate.png'); }
            elseif ($slot->getStatus() == 'attente' || $slot->getStatus() == 'inscrit') { echo image_tag('16/slot_waiting.png'); }
            ?>
            </td>
            <td><?= $slot->getPosition() ?></td>
            <td><? if (!$slot->getTeamId()): ?><?= $slot->getStatus() ?></td>
                <td>
            <? else: ?>
                <b><?= link_to($slot->TeamName($slot->getTeamId()), 'team/view?slug=' . $slot->TeamSlug($slot->getTeamId())); ?></b>
                </td>
        <? include_component('team', 'players', array('idteam' => $slot->getTeamId())) ?>
        <? endif; ?>
        </tr>
    <? endforeach; ?>
</table>
<br/>
&nbsp;&nbsp;&nbsp;
<?=image_tag('16/slot_validate.png')?> <?=__('Valide')?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?=image_tag('16/slot_waiting.png')?> <?=__('En attente de paiement')?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
